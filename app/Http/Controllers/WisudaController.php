<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranWisuda;
use App\Models\Toga;
use App\Models\Mahasiswa;

class WisudaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])->get();
        return view('viewmahasiswa.wisuda1', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $field = $request->input('field');
        $pendaftaran = PendaftaranWisuda::findOrFail($id);

        // Handle Edit Wisuda (Tanggal, Ukuran, Catatan)
        if ($field === 'edit_wisuda') {
            $request->validate([
                'tgl_pendaftaran' => 'required|date',
                'ukuran' => 'required|string',
                'catatan' => 'nullable|string'
            ]);

            $pendaftaran->tgl_pendaftaran = $request->tgl_pendaftaran;

            // Update atau buat data toga
            if ($pendaftaran->toga) {
                $pendaftaran->toga->ukuran = $request->ukuran;
                $pendaftaran->toga->catatan = $request->catatan;
                $pendaftaran->toga->save();
            } else {
                Toga::create([
                    'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                    'ukuran' => $request->ukuran,
                    'catatan' => $request->catatan
                ]);
            }

            $pendaftaran->save();
            return redirect()->back()->with('success', 'Data wisuda berhasil diperbarui!');
        }

        // Handle Validasi Finance
        if ($field === 'is_valid_finance') {
            $pendaftaran->is_valid_finance = $request->has('is_valid_finance') && $request->is_valid_finance == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Validasi Finance berhasil diperbarui!');
        }

        // Handle Validasi Perpus
        if ($field === 'is_valid_perpus') {
            $pendaftaran->is_valid_perpus = $request->has('is_valid_perpus') && $request->is_valid_perpus == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Validasi Perpustakaan berhasil diperbarui!');
        }

        // Handle Validasi Fakultas
        if ($field === 'is_valid_fakultas') {
            $pendaftaran->is_valid_fakultas = $request->has('is_valid_fakultas') && $request->is_valid_fakultas == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Validasi Fakultas berhasil diperbarui!');
        }

        // Handle Validasi BAAK
        if ($field === 'is_valid_baak') {
            $pendaftaran->is_valid_baak = $request->has('is_valid_baak') && $request->is_valid_baak == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Validasi BAAK berhasil diperbarui!');
        }

        // Handle Catatan Finance
        if ($field === 'catatan_finance') {
            $pendaftaran->catatan_finance = $request->catatan_finance;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Catatan Finance berhasil disimpan!');
        }

        // Handle Catatan Perpus
        if ($field === 'catatan_perpus') {
            $pendaftaran->catatan_perpus = $request->catatan_perpus;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Catatan Perpustakaan berhasil disimpan!');
        }

        // Handle Catatan Fakultas
        if ($field === 'catatan_fakultas') {
            $pendaftaran->catatan_fakultas = $request->catatan_fakultas;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Catatan Fakultas berhasil disimpan!');
        }

        // Handle Catatan BAAK
        if ($field === 'catatan_baak') {
            $pendaftaran->catatan_baak = $request->catatan_baak;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Catatan BAAK berhasil disimpan!');
        }

        return redirect()->back()->with('error', 'Field tidak dikenali!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pendaftaran = PendaftaranWisuda::findOrFail($id);
            
            // Hapus data toga jika ada
            if ($pendaftaran->toga) {
                $pendaftaran->toga->delete();
            }
            
            // Hapus pendaftaran
            $pendaftaran->delete();
            
            return redirect()->back()->with('success', 'Data wisuda berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}