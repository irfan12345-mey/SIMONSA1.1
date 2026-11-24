<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Kebun;
use App\Models\Blok;
use App\Models\HasilPanen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalPengguna = Pengguna::count();
            $totalKebun = Kebun::count();
            $totalBlok = Blok::count();
            $totalPanen = HasilPanen::sum('berat_tbs_kg');
            $totalCatatan = HasilPanen::count();

            return view('pages.admin.dashboard', compact('totalPengguna', 'totalKebun', 'totalBlok', 'totalPanen', 'totalCatatan'));
        } elseif ($user->role === 'pemilik') {
            // Ambil ID kebun milik pemilik ini
            $kebunIds = Kebun::where('id_pemilik', $user->id_pengguna)->pluck('id_kebun');
            $blokIds = Blok::whereIn('id_kebun', $kebunIds)->pluck('id_blok');

            // Ringkasan
            $totalPanen = HasilPanen::whereIn('id_blok', $blokIds)->sum('berat_tbs_kg');
            $totalCatatan = HasilPanen::whereIn('id_blok', $blokIds)->count();
            $totalBlok = $blokIds->count();

            // Data Grafik: Total panen per bulan (6 bulan terakhir)
            $grafikData = HasilPanen::select(
                DB::raw('DATE_FORMAT(tanggal_panen, "%Y-%m") as bulan'),
                DB::raw('SUM(berat_tbs_kg) as total')
            )
                ->whereIn('id_blok', $blokIds)
                ->groupBy('bulan')
                ->orderBy('bulan', 'asc')
                ->limit(6)
                ->get();

            $labels = $grafikData->pluck('bulan');
            $dataPanen = $grafikData->pluck('total');

            // --- DATA PERBANDINGAN ANTARBLOK (P-05) ---
            $perbandinganBlok = HasilPanen::select(
                'id_blok',
                DB::raw('SUM(berat_tbs_kg) as total_panen')
            )
                ->whereIn('id_blok', $blokIds)
                ->groupBy('id_blok')
                ->with('blok.kebun')
                ->orderByDesc('total_panen')
                ->get();
            // -------------------------------------------

            return view('pages.pemilik.dashboard', compact(
                'totalPanen',
                'totalCatatan',
                'totalBlok',
                'labels',
                'dataPanen',
                'perbandinganBlok'
            ));
        } elseif ($user->role === 'petugas') {
            $totalCatatanSaya = HasilPanen::where('id_petugas', $user->id_pengguna)->count();
            $totalPanenSaya = HasilPanen::where('id_petugas', $user->id_pengguna)->sum('berat_tbs_kg');

            $catatanTerakhir = HasilPanen::where('id_petugas', $user->id_pengguna)
                ->with('blok.kebun')
                ->latest()
                ->take(5)
                ->get();

            return view('pages.petugas.dashboard', compact('totalCatatanSaya', 'totalPanenSaya', 'catatanTerakhir'));
        }

        abort(403);
    }
}
