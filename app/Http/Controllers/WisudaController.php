<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranWisuda;
use App\Models\Toga;
use App\Models\Mahasiswa;

class WisudaController extends Controller
{
    public function index()
    {
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])->get();
        return view('viewmahasiswa.wisuda1', compact('data'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}

    public function update(Request $request, $id)
    {
        $field       = $request->input('field');
        $pendaftaran = PendaftaranWisuda::findOrFail($id);

        // ✅ Handle Edit Wisuda
        if ($field === 'edit_wisuda') {
            $request->validate([
                'tgl_pendaftaran' => 'required|date',
                'ukuran'          => 'required|string',
                'catatan'         => 'nullable|string',
                'kode_pen'        => 'nullable|string|max:50',
                'nama_kaprodi'    => 'nullable|string|max:255',
                'nama_dekan'      => 'nullable|string|max:255',
            ]);

            $pendaftaran->tgl_pendaftaran = $request->tgl_pendaftaran;
            $pendaftaran->ipk             = $request->ipk;
            $pendaftaran->judul_skripsi   = $request->judul_skripsi;
            $pendaftaran->nama_kaprodi    = $request->nama_kaprodi; // ✅
            $pendaftaran->nama_dekan      = $request->nama_dekan;   // ✅

            if ($pendaftaran->toga) {
                $pendaftaran->toga->ukuran   = $request->ukuran;
                $pendaftaran->toga->catatan  = $request->catatan;
                $pendaftaran->toga->kode_pen = $request->kode_pen ?? null;
                $pendaftaran->toga->save();
            } else {
                Toga::create([
                    'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                    'ukuran'         => $request->ukuran,
                    'catatan'        => $request->catatan,
                    'kode_pen'       => $request->kode_pen ?? null,
                ]);
            }

            $pendaftaran->save();
            return redirect()->back()->with('success', 'Graduation data successfully updated!');
        }

        if ($field === 'is_valid_finance') {
            $pendaftaran->is_valid_finance = $request->has('is_valid_finance') && $request->is_valid_finance == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Finance validation successfully updated!');
        }

        if ($field === 'is_valid_perpus') {
            $pendaftaran->is_valid_perpus = $request->has('is_valid_perpus') && $request->is_valid_perpus == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Library validation successfully updated!');
        }

        if ($field === 'is_valid_fakultas') {
            $pendaftaran->is_valid_fakultas = $request->has('is_valid_fakultas') && $request->is_valid_fakultas == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Faculty validation successfully updated!');
        }

        if ($field === 'is_valid_baak') {
            $pendaftaran->is_valid_baak = $request->has('is_valid_baak') && $request->is_valid_baak == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'BAAK validation successfully updated!');
        }

        if ($field === 'is_valid_csdl') {
            $pendaftaran->is_valid_csdl = $request->has('is_valid_csdl') && $request->is_valid_csdl == 1 ? 1 : 0;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'CSDL validation successfully updated!');
        }

        if ($field === 'catatan_finance') {
            $pendaftaran->catatan_finance = $request->catatan_finance;
            $pendaftaran->save();
                return redirect()->back()->with('success', 'Finance Note saved successfully!');
            }

        if ($field === 'catatan_perpus') {
            $pendaftaran->catatan_perpus = $request->catatan_perpus;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Library Note saved successfully!');
        }

        if ($field === 'catatan_fakultas') {
            $pendaftaran->catatan_fakultas = $request->catatan_fakultas;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'Faculty Notes saved successfully!');
        }

        if ($field === 'catatan_baak') {
            $pendaftaran->catatan_baak = $request->catatan_baak;
            $pendaftaran->save();
            return redirect()->back()->with('success', 'BAAK notes saved successfully!');
        }

        return redirect()->back()->with('error', 'Field tidak dikenali!');
    }

    public function destroy($id)
    {
        try {
            $pendaftaran = PendaftaranWisuda::findOrFail($id);
            if ($pendaftaran->toga) {
                $pendaftaran->toga->delete();
            }
            $pendaftaran->delete();
            return redirect()->back()->with('success', 'Graduation data successfully deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete data: ' . $e->getMessage());
        }
    }

    public function print($id)
    {
        $pendaftaran = PendaftaranWisuda::with(['mahasiswa', 'toga'])->findOrFail($id);
        return view('viewmahasiswa.wisuda1_print', compact('pendaftaran'));
    }
}