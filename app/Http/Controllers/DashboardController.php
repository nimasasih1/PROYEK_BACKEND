<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Toga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard'); // pastikan ada file resources/views/dashboard.blade.php
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
}
