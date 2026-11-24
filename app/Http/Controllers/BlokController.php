<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\Kebun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlokController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $bloks = Blok::with('kebun')->get();
        } else {
            // Ambil blok yang kebunnya milik pemilik yang login
            $bloks = Blok::whereHas('kebun', function($query) use ($user) {
                $query->where('id_pemilik', $user->id_pengguna);
            })->with('kebun')->get();
        }

        $isAdmin = $user->role === 'admin';
        return view('pages.blok.index', compact('bloks', 'isAdmin'));
    }

    public function create()
    {
        if (Auth::user()->role === 'admin') abort(403);

        // Ambil kebun milik pemilik ini untuk ditampilkan di dropdown
        $kebuns = Kebun::where('id_pemilik', Auth::user()->id_pengguna)->get();
        return view('pages.blok.create', compact('kebuns'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') abort(403);

        $request->validate([
            'id_kebun' => 'required|exists:kebun,id_kebun',
            'kode_blok' => 'required|string|max:50',
            'nama_blok' => 'nullable|string|max:100',
            'luas_hektare' => 'nullable|numeric',
        ]);

        // Validasi keamanan: pastikan pemilik hanya bisa menambah blok di kebunnya sendiri
        $kebun = Kebun::findOrFail($request->id_kebun);
        if ($kebun->id_pemilik !== Auth::user()->id_pengguna) {
            abort(403, 'Anda tidak berhak menambah blok di kebun ini.');
        }

        Blok::create($request->all());

        return redirect()->route('blok.index')->with('success', 'Data blok berhasil ditambahkan.');
    }

    public function edit(Blok $blok)
    {
        if (Auth::user()->role === 'admin' || $blok->kebun->id_pemilik !== Auth::user()->id_pengguna) {
            abort(403);
        }

        $kebuns = Kebun::where('id_pemilik', Auth::user()->id_pengguna)->get();
        return view('pages.blok.edit', compact('blok', 'kebuns'));
    }

    public function update(Request $request, Blok $blok)
    {
        if (Auth::user()->role === 'admin' || $blok->kebun->id_pemilik !== Auth::user()->id_pengguna) {
            abort(403);
        }

        $request->validate([
            'id_kebun' => 'required|exists:kebun,id_kebun',
            'kode_blok' => 'required|string|max:50',
            'nama_blok' => 'nullable|string|max:100',
            'luas_hektare' => 'nullable|numeric',
        ]);

        $blok->update($request->all());

        return redirect()->route('blok.index')->with('success', 'Data blok berhasil diperbarui.');
    }

    public function destroy(Blok $blok)
    {
        if (Auth::user()->role === 'admin' || $blok->kebun->id_pemilik !== Auth::user()->id_pengguna) {
            abort(403);
        }

        $blok->delete();

        return redirect()->route('blok.index')->with('success', 'Data blok berhasil dihapus.');
    }
}