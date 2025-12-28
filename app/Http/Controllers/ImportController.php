<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Imports\MahasiswaImport;
use App\Imports\SkpiImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function users(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file'));
        return back()->with('success', 'Users berhasil diimport');
    }

    // public function mahasiswa(Request $request)
    // {
    //     Excel::import(new MahasiswaImport, $request->file('file'));
    //     return back()->with('success', 'Mahasiswa berhasil diimport');
    // }

    public function skpi(Request $request)
    {
        Excel::import(new SkpiImport, $request->file('file'));
        return back()->with('success', 'SKPI berhasil diimport');
    }
}

