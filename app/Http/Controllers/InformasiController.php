<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Qna;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        $data = Informasi::all();
        return view('dashboard.index1', compact('data'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $fotos = [];
        foreach (['foto_gallery', 'foto_gallery_2', 'foto_gallery_3', 'foto_gallery_4'] as $field) {
            if ($request->hasFile($field)) {
                $file     = $request->file($field);
                $filename = time() . '_' . $field . '_' . $file->getClientOriginalName();
                if (!file_exists(public_path('uploads/gallery'))) {
                    mkdir(public_path('uploads/gallery'), 0755, true);
                }
                $file->move(public_path('uploads/gallery'), $filename);
                $fotos[$field] = 'uploads/gallery/' . $filename;
            } else {
                $fotos[$field] = null;
            }
        }

        Informasi::create([
            'lokasi'           => $request->lokasi,
            'jumlah_wisudawan' => $request->jumlah_wisudawan,
            'mahasiswa_aktif'  => $request->mahasiswa_aktif,
            'calon_lulusan'    => $request->calon_lulusan,
            'jadwal_wisuda'    => $request->jadwal_wisuda,
            'informasi_baak'   => $request->informasi_baak,
            'foto_gallery'     => $fotos['foto_gallery'],
            'foto_gallery_2'   => $fotos['foto_gallery_2'],
            'foto_gallery_3'   => $fotos['foto_gallery_3'],
            'foto_gallery_4'   => $fotos['foto_gallery_4'],
        ]);

        return redirect()->back()->with('success_swal', true);
    }

    // Update data
    public function update(Request $request, $id)
    {
        $info = Informasi::findOrFail($id);

        foreach (['foto_gallery', 'foto_gallery_2', 'foto_gallery_3', 'foto_gallery_4'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus foto lama
                if (!empty($info->$field) && file_exists(public_path($info->$field))) {
                    unlink(public_path($info->$field));
                }
                $file     = $request->file($field);
                $filename = time() . '_' . $field . '_' . $file->getClientOriginalName();
                if (!file_exists(public_path('uploads/gallery'))) {
                    mkdir(public_path('uploads/gallery'), 0755, true);
                }
                $file->move(public_path('uploads/gallery'), $filename);
                $info->$field = 'uploads/gallery/' . $filename;
            }
        }

        $info->lokasi           = $request->lokasi;
        $info->jumlah_wisudawan = $request->jumlah_wisudawan;
        $info->mahasiswa_aktif  = $request->mahasiswa_aktif;
        $info->calon_lulusan    = $request->calon_lulusan;
        $info->jadwal_wisuda    = $request->jadwal_wisuda;
        $info->informasi_baak   = $request->informasi_baak;
        $info->save();

        return redirect()->back()->with('success1_swal', true);
    }

    // Hapus data
    public function destroy($id)
    {
        $info = Informasi::findOrFail($id);

        // Hapus foto juga kalau ada
        if (!empty($info->foto_gallery) && file_exists(public_path($info->foto_gallery))) {
            unlink(public_path($info->foto_gallery));
        }

        $info->delete();
        return redirect()->route('dashboard.index1')->with('success3_swal', true);
    }

    public function qnaIndex()
    {
        $qna = Qna::all();
        return view('dashboard.qna', compact('qna'));
    }

    public function qnaCreate()
    {
        return view('dashboard.qna.create');
    }

    public function qnaStore(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban'    => 'required|string',
        ]);

        Qna::create($request->all());

        return redirect()->route('dashboard.qna')->with('success_swal', true);
    }

    public function qnaEdit($id)
    {
        $qna = Qna::findOrFail($id);
        return view('dashboard.qna', compact('qna'));
    }

    public function qnaShow($id)
    {
        $qna = Qna::findOrFail($id);
        return response()->json($qna);
    }

    public function qnaUpdate(Request $request, $id)
    {
        $qna = Qna::findOrFail($id);

        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban'    => 'required|string',
        ]);

        $qna->update($request->all());

        return redirect()->route('dashboard.qna')->with('success1_swal', true);
    }

    public function qnaDestroy($id_qna)
    {
        $qna = Qna::findOrFail($id_qna);
        $qna->delete();

        return redirect()->route('dashboard.qna')->with('success2_swal', true);
    }

    public function toggleStatusKesan($id)
    {
        $kesan = \App\Models\KesanModel::findOrFail($id);
        $kesan->status = ($kesan->status == 1) ? 0 : 1;
        $kesan->save();

        return back()->with('success', 'Status changed successfully!');
    }
}