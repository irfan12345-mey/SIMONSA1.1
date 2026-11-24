<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa akses
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya Admin yang bisa mengelola pengguna.');
        }

        // Ambil semua pengguna
        $penggunas = Pengguna::orderBy('role', 'asc')->get();

        return view('pages.admin.pengguna.index', compact('penggunas'));
    }

    public function toggleStatus(Pengguna $pengguna)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Jangan biarkan admin menonaktifkan dirinya sendiri
        if ($pengguna->id_pengguna === Auth::user()->id_pengguna) {
            return redirect()->back()->with('error', 'Anda tidak bisa menonaktifkan akun Anda sendiri.');
        }

        // Ubah status: aktif -> nonaktif, atau sebaliknya
        $newStatus = $pengguna->status_akun === 'aktif' ? 'nonaktif' : 'aktif';
        $pengguna->update(['status_akun' => $newStatus]);

        return redirect()->back()->with('success', 'Status akun ' . $pengguna->nama . ' berhasil diubah menjadi ' . $newStatus . '.');
    }
}