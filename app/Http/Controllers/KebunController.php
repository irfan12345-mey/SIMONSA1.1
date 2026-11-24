<?php

namespace App\Http\Controllers;

use App\Models\Kebun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KebunController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Kebun::with('pemilik');

        // Filter berdasarkan Role
        if ($user->role === 'admin') {
            // Admin melihat semua
        } else {
            $query->where('id_pemilik', $user->id_pengguna);
        }

        // Fitur Pencarian
        if ($request->filled('search')) {
            $query->where('nama_kebun', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
        }

        $kebuns = $query->get();
        $isAdmin = $user->role === 'admin';

        return view('pages.kebun.index', compact('kebuns', 'isAdmin'));
    }

    public function create()
    {
        // Cek jika yang akses adalah admin, tolak
        if (Auth::user()->role === 'admin') {
            abort(403, 'Admin tidak diizinkan menambah data kebun.');
        }

        return view('pages.kebun.create');
    }

    public function store(Request $request)
    {
        // Cek jika yang akses adalah admin, tolak
        if (Auth::user()->role === 'admin') {
            abort(403, 'Admin tidak diizinkan menyimpan data kebun.');
        }

        $request->validate([
            'nama_kebun' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Kebun::create([
            'id_pemilik' => Auth::user()->id_pengguna,
            'nama_kebun' => $request->nama_kebun,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kebun.index')->with('success', 'Data kebun berhasil ditambahkan.');
    }

    public function edit(Kebun $kebun)
    {
        // Cek jika admin ATAU jika pemilik bukan dia yang punya kebun ini
        if (Auth::user()->role === 'admin' || $kebun->id_pemilik !== Auth::user()->id_pengguna) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        return view('pages.kebun.edit', compact('kebun'));
    }

    public function update(Request $request, Kebun $kebun)
    {
        // Cek jika admin ATAU jika pemilik bukan dia yang punya kebun ini
        if (Auth::user()->role === 'admin' || $kebun->id_pemilik !== Auth::user()->id_pengguna) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        $request->validate([
            'nama_kebun' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kebun->update($request->all());

        return redirect()->route('kebun.index')->with('success', 'Data kebun berhasil diperbarui.');
    }

    public function destroy(Kebun $kebun)
    {
        // Cek jika admin ATAU jika pemilik bukan dia yang punya kebun ini
        if (Auth::user()->role === 'admin' || $kebun->id_pemilik !== Auth::user()->id_pengguna) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        $kebun->delete();

        return redirect()->route('kebun.index')->with('success', 'Data kebun berhasil dihapus.');
    }
}