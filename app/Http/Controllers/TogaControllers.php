<?php

namespace App\Http\Controllers;

use App\Models\Toga;
use App\Models\PendaftaranWisuda;
use Illuminate\Http\Request;

class TogaControllers extends Controller
{
    public function index()
    {
        $dataToga = Toga::with(['pendaftaran.mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pendaftaran = PendaftaranWisuda::with('mahasiswa')->get();

        return view('Toga.index', compact('dataToga', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pendaftaran' => 'required|exists:pendaftaran_wisuda,id_pendaftaran',
            'ukuran' => 'required|string|max:50',
            'catatan' => 'nullable|string',
            'ttd' => 'required|string', // hasil canvas base64 atau text
        ]);

            Toga::create($request->all());

        return redirect()->route('Toga.index')
                         ->with('success', 'Data pengambilan berhasil disimpan');
    }
}
