<?php

namespace App\Http\Controllers;

use App\Models\HasilPanen;
use App\Models\Blok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilPanenController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Memulai query dasar
        $query = HasilPanen::with(['blok.kebun', 'petugas']);

        // Filter berdasarkan Role
        if ($user->role === 'admin') {
            // Admin lihat semua
        } elseif ($user->role === 'pemilik') {
            $query->whereHas('blok.kebun', function ($q) use ($user) {
                $q->where('id_pemilik', $user->id_pengguna);
            });
        } else {
            // Petugas hanya lihat yang dia input
            $query->where('id_petugas', $user->id_pengguna);
        }

        // --- FITUR PENCARIAN & FILTER (T-04) ---

        // 1. Pencarian berdasarkan nama kebun atau kode blok
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('blok', function ($q) use ($search) {
                $q->where('kode_blok', 'like', "%{$search}%")
                    ->orWhereHas('kebun', function ($q2) use ($search) {
                        $q2->where('nama_kebun', 'like', "%{$search}%");
                    });
            });
        }

        // 2. Filter berdasarkan rentang tanggal (Dari - Sampai)
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal_panen', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal_panen', '<=', $request->sampai_tanggal);
        }

        // Urutkan dari yang terbaru
        $hasilPanens = $query->latest()->get();

        return view('pages.hasil-panen.index', compact('hasilPanens'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Hanya Petugas yang bisa mencatat hasil panen.');
        }

        $bloks = Blok::with('kebun')->get();
        return view('pages.hasil-panen.create', compact('bloks'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'petugas') {
            abort(403);
        }

        $request->validate([
            'id_blok' => 'required|exists:blok,id_blok',
            'tanggal_panen' => 'required|date',
            'berat_tbs_kg' => 'required|numeric|min:0.1',
            'keterangan' => 'nullable|string',
        ]);

        HasilPanen::create([
            'id_blok' => $request->id_blok,
            'id_petugas' => Auth::user()->id_pengguna,
            'tanggal_panen' => $request->tanggal_panen,
            'berat_tbs_kg' => $request->berat_tbs_kg,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('hasil-panen.index')->with('success', 'Catatan hasil panen berhasil ditambahkan.');
    }

    public function edit(HasilPanen $hasilPanen)
    {
        if (Auth::user()->role !== 'petugas' || $hasilPanen->id_petugas !== Auth::user()->id_pengguna) {
            abort(403, 'Anda tidak berhak mengedit catatan ini.');
        }

        $bloks = Blok::with('kebun')->get();
        return view('pages.hasil-panen.edit', compact('hasilPanen', 'bloks'));
    }

    public function update(Request $request, HasilPanen $hasilPanen)
    {
        if (Auth::user()->role !== 'petugas' || $hasilPanen->id_petugas !== Auth::user()->id_pengguna) {
            abort(403);
        }

        $request->validate([
            'id_blok' => 'required|exists:blok,id_blok',
            'tanggal_panen' => 'required|date',
            'berat_tbs_kg' => 'required|numeric|min:0.1',
            'keterangan' => 'nullable|string',
        ]);

        $hasilPanen->update($request->all());

        return redirect()->route('hasil-panen.index')->with('success', 'Catatan hasil panen berhasil diperbarui.');
    }

    public function destroy(HasilPanen $hasilPanen)
    {
        if (Auth::user()->role !== 'petugas' || $hasilPanen->id_petugas !== Auth::user()->id_pengguna) {
            abort(403);
        }

        $hasilPanen->delete();

        return redirect()->route('hasil-panen.index')->with('success', 'Catatan hasil panen berhasil dihapus.');
    }

    // ==========================================
    // FUNGSI BARU: UNTUK MENAMPILKAN LAPORAN
    // ==========================================
    public function laporan(Request $request)
    {
        $user = Auth::user();

        // Ambil input filter (default: bulan & tahun saat ini)
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $query = HasilPanen::with(['blok.kebun', 'petugas'])
            ->whereMonth('tanggal_panen', $bulan)
            ->whereYear('tanggal_panen', $tahun);

        // Filter data sesuai role yang login
        if ($user->role === 'petugas') {
            $query->where('id_petugas', $user->id_pengguna);
        } elseif ($user->role === 'pemilik') {
            $query->whereHas('blok.kebun', function ($q) use ($user) {
                $q->where('id_pemilik', $user->id_pengguna);
            });
        }

        $laporans = $query->orderBy('tanggal_panen', 'asc')->get();
        $totalBerat = $laporans->sum('berat_tbs_kg');

        return view('pages.hasil-panen.laporan', compact('laporans', 'bulan', 'tahun', 'totalBerat'));
    }
}
