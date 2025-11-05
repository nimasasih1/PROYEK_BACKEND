<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Toga;
use Illuminate\Http\Request;
use App\Models\Skpi;
use App\Models\Informasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    {
        // Hitung total data hanya untuk dashboard admin
        $jumlahProfil = Mahasiswa::count();
        $jumlahWisuda = PendaftaranWisuda::count();
        $jumlahSkpi = Skpi::count();
        $jumlahToga = Toga::count();
        $jumlahPending = PendaftaranWisuda::where('status_pendaftaran', 'pending')->count();
        $jumlahSelesai = PendaftaranWisuda::where('status_pendaftaran', 'selesai')->count();

        // Kirim hanya ke tampilan dashboard admin
        return view('layouts.dashboard', compact(
            'jumlahProfil',
            'jumlahWisuda',
            'jumlahSkpi',
            'jumlahToga',
            'jumlahPending',
            'jumlahSelesai'
        ));
    }


    public function index2()
    {
        return view('layouts2.dashboard'); // pastikan ada file resources/views/dashboard.blade.php
    }

    public function index3()
    {
        return view('layouts3.dashboard'); // pastikan ada file resources/views/dashboard.blade.php
    }

    public function index4()
    {
        return view('layouts4.dashboard'); // pastikan ada file resources/views/dashboard.blade.php
    }
    public function wisuda1()
    {
        // Gabungkan tabel mahasiswa, pendaftaran, dan toga
        $data = Mahasiswa::with(['pendaftaran.toga'])->get();

        return view('viewmahasiswa.daftar_wisuda1', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $info = Informasi::findOrFail($id);
        $info->status = $request->status;
        $info->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate!');
    }
}
