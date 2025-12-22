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
        $request->validate([
            'lokasi' => 'required|string|max:255',
            'jumlah_wisudawan' => 'required|integer',
            'jadwal_wisuda' => 'required|date',
            'informasi_baak' => 'nullable|string',
        ]);

        Informasi::create($request->only([
            'lokasi',
            'jumlah_wisudawan',
            'jadwal_wisuda',
            'informasi_baak',
        ]));

        return redirect()->route('dashboard.index1')
            ->with('success_swal', true);
    }

    // Form edit
    public function update(Request $request, $id)
    {
        $info = Informasi::findOrFail($id);

        $request->validate([
            'lokasi' => 'required|string|max:255',
            'jumlah_wisudawan' => 'required|integer',
            'jadwal_wisuda' => 'required|date',
            'informasi_baak' => 'nullable|string',
        ]);

        // Hanya update field yang ada di table
        $info->update($request->only([
            'lokasi',
            'jumlah_wisudawan',
            'jadwal_wisuda',
            'informasi_baak',
        ]));

        return redirect()->route('dashboard.index1')
            ->with('success1_swal', true);
    }


    // Hapus data
    public function destroy($id)
    {
        $info = Informasi::findOrFail($id);
        $info->delete();
        return redirect()->route('dashboard.index1')
            ->with('success3_swal', true);
    }

    public function qnaIndex()
    {
        $qna = Qna::all();
        return view('dashboard.qna', compact('qna'));
    }

    // Form tambah Q&A
    public function qnaCreate()
    {
        return view('dashboard.qna.create');
    }

    // Simpan Q&A baru
    public function qnaStore(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        Qna::create($request->all());

        return redirect()->route('dashboard.qna')
            ->with('success_swal', true);
    }

    // Form edit Q&A
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

    // Update Q&A
    public function qnaUpdate(Request $request, $id)
    {
        $qna = Qna::findOrFail($id);

        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        $qna->update($request->all());

        return redirect()->route('dashboard.qna')
            ->with('success1_swal', true);
    }

    // Hapus Q&A
    public function qnaDestroy($id_qna)
    {
        $qna = Qna::findOrFail($id_qna);
        $qna->delete();

        return redirect()->route('dashboard.qna')
            ->with('success2_swal', true);
    }

    public function up()
    {
        Schema::table('kesan_models', function (Blueprint $table) {
            // Default 0 (Draft), 1 (Publish)
            $table->tinyInteger('status')->default(0)->after('kesan');
        });
    }

    public function down()
    {
        Schema::table('kesan_models', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

    public function toggleStatusKesan($id)
    {
        $kesan = \App\Models\KesanModel::findOrFail($id);

        // Toggle antara 0 dan 1
        $kesan->status = ($kesan->status == 1) ? 0 : 1;
        $kesan->save();

        return back()->with('success', 'Status berhasil diubah!');
    }
}
