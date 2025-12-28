<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyaratKetentuanController extends Controller
{
    public function index()
    {
        $hasCatatan = false; // atau ambil dari database sesuai kebutuhan
        return view('syarat-ketentuan', compact('hasCatatan'));
    }
}