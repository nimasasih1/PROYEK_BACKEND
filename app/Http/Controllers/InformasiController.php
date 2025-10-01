<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $data = Informasi::all();
        return view('dashboard.index1', compact('data'));
    }

    // Form tambah data
    public function create()
    {
        return view('dashboard.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_undangan' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'jumlah_wisudawan' => 'required|integer',
            'jadwal_wisuda' => 'required|date',
        ]);

        Informasi::create($request->all());
        return redirect()->route('dashboard.index1')->with('success', 'Informasi berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $info = Informasi::findOrFail($id);
        return view('dashboard.edit', compact('info'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $info = Informasi::findOrFail($id);

        $request->validate([
            'jadwal_undangan' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'jumlah_wisudawan' => 'required|integer',
            'jadwal_wisuda' => 'required|date',
        ]);

        $info->update($request->all());
        return redirect()->route('dashboard.index1')->with('success', 'Informasi berhasil diupdate');
    }

    // Hapus data
    public function destroy($id)
    {
        $info = Informasi::findOrFail($id);
        $info->delete();
        return redirect()->route('dashboard.index1')->with('success', 'Informasi berhasil dihapus');
    }
}
