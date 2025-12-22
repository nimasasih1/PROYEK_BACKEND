<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SyaratKetentuan;

class SyaratKetentuanControllers extends Controller
{
    /* ================= INDEX ================= */
    public function syaratIndex()
    {
        $syarat = SyaratKetentuan::all();
        return view('dashboard.syarat', compact('syarat'));
    }

    /* ================= HELPER UPLOAD FOTO ================= */
    private function uploadFoto($file)
    {
        $namaFile = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('syarat_ketentuan'), $namaFile);

        // path yang disimpan ke database
        return 'syarat_ketentuan/' . $namaFile;
    }

    /* ================= STORE ================= */
    public function syaratStore(Request $request)
    {
        $request->validate([
            'deskripsi_1' => 'required',
            'deskripsi_2' => 'required',
            'deskripsi_3' => 'required',
            'foto_1' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_2' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_3' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto1 = $this->uploadFoto($request->file('foto_1'));
        $foto2 = $this->uploadFoto($request->file('foto_2'));
        $foto3 = $this->uploadFoto($request->file('foto_3'));

        SyaratKetentuan::create([
            'deskripsi_1' => $request->deskripsi_1,
            'deskripsi_2' => $request->deskripsi_2,
            'deskripsi_3' => $request->deskripsi_3,
            'foto_1' => $foto1,
            'foto_2' => $foto2,
            'foto_3' => $foto3,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /* ================= SHOW (AJAX EDIT) ================= */
    public function syaratShow($id)
    {
        return response()->json(
            SyaratKetentuan::findOrFail($id)
        );
    }

    /* ================= UPDATE ================= */
    public function syaratUpdate(Request $request, $id)
    {
        $data = SyaratKetentuan::findOrFail($id);

        $request->validate([
            'deskripsi_1' => 'required',
            'deskripsi_2' => 'required',
            'deskripsi_3' => 'required',
            'foto_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_1')) {
            if ($data->foto_1 && file_exists(public_path($data->foto_1))) {
                unlink(public_path($data->foto_1));
            }
            $data->foto_1 = $this->uploadFoto($request->file('foto_1'));
        }

        if ($request->hasFile('foto_2')) {
            if ($data->foto_2 && file_exists(public_path($data->foto_2))) {
                unlink(public_path($data->foto_2));
            }
            $data->foto_2 = $this->uploadFoto($request->file('foto_2'));
        }

        if ($request->hasFile('foto_3')) {
            if ($data->foto_3 && file_exists(public_path($data->foto_3))) {
                unlink(public_path($data->foto_3));
            }
            $data->foto_3 = $this->uploadFoto($request->file('foto_3'));
        }

        $data->update([
            'deskripsi_1' => $request->deskripsi_1,
            'deskripsi_2' => $request->deskripsi_2,
            'deskripsi_3' => $request->deskripsi_3,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /* ================= DELETE ================= */
    public function syaratDestroy($id)
    {
        $data = SyaratKetentuan::findOrFail($id);

        foreach (['foto_1','foto_2','foto_3'] as $foto) {
            if ($data->$foto && file_exists(public_path($data->$foto))) {
                unlink(public_path($data->$foto));
            }
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
