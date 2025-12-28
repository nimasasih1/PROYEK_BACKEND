<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skpi;
use App\Models\Mahasiswa;

class SkpiController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $data = Skpi::with(['mahasiswa'])
            ->orderBy('id_skpi', 'desc')
            ->get();

        return view('skpi', compact('user', 'mahasiswa', 'data'));
    }

    public function store(Request $request)
    {
        // Ambil mahasiswa dari user login
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->username)->firstOrFail();

        // ================= VALIDASI =================
        $request->validate([
            'aktiv_pres_penghargaan' => 'nullable|string',
            'magang' => 'nullable|string',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        // ================= UPLOAD FILE PDF =================
        $fileName = null;

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('skpi'), $fileName);
        }

        // ================= DATA INSERT =================
        $data = [
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'tgl_pengajuan_mahasiswa' => $request->tgl_pengajuan_mahasiswa,

            // AMBIL LANGSUNG DARI MAHASISWA (BIAR TIDAK NULL)
            'tempat_lahir' => $mahasiswa->tempat_lahir,

            'tahun_lulus' => $request->tahun_lulus,
            'no_ijazah' => $request->no_ijazah,
            'gelar' => $request->gelar,
            'sk_pendirian_perti' => $request->sk_pendirian_perti,
            'persyaratan_penerimaan' => $request->persyaratan_penerimaan,
            'nama_perti' => $request->nama_perti,
            'bahasa_pengantar_kuliah' => $request->bahasa_pengantar_kuliah,
            'sistem_penilaian' => $request->sistem_penilaian,
            'kelas' => $request->kelas,
            'lama_studi_rg' => $request->lama_studi_rg,
            'jenjang_pd_lanjutan' => $request->jenjang_pd_lanjutan,
            'jenjang_kualif_kkn1' => $request->jenjang_kualif_kkn1,
            'status_profesi' => $request->status_profesi,
            'penguasaan_pengetahuan' => $request->penguasaan_pengetahuan,
            'aktiv_pres_penghargaan' => $request->aktiv_pres_penghargaan,
            'magang' => $request->magang,
            'jenjangpend_syaratbelajar' => $request->jenjangpend_syaratbelajar,
            'sks_lamastudi' => $request->sks_lamastudi,
            'kota' => $request->kota,
            'tanggal_skpi' => $request->tanggal_skpi,
            'kemampuan_kerja' => $request->kemampuan_kerja,
            'info_kkni' => $request->info_kkni,
            // FILE PDF
            'file_pdf' => $fileName,
        ];

        // ================= SIMPAN =================
        Skpi::create($data);

        return redirect()
            ->route('beranda')
            ->with('success1_swal', true);
    }

    public function update(Request $request, $id)
    {
        $skpi = Skpi::findOrFail($id);

        $validated = $request->validate([
            'tgl_pengajuan_mahasiswa' => 'required|date',

            'tempat_lahir' => 'nullable|string',
            'tgl_lahir' => 'nullable|date',
            'tahun_lulus' => 'nullable|string',
            'no_ijazah' => 'nullable|string',
            'gelar' => 'nullable|string',
            'sk_pendirian_perti' => 'nullable|string',
            'persyaratan_penerimaan' => 'nullable|string',
            'nama_perti' => 'nullable|string',
            'bahasa_pengantar_kuliah' => 'nullable|string',
            'sistem_penilaian' => 'nullable|string',
            'kelas' => 'nullable|string',
            'lama_studi_rg' => 'nullable|string',
            'jenjang_pd_lanjutan' => 'nullable|string',
            'jenjang_kualif_kkn1' => 'nullable|string',
            'status_profesi' => 'nullable|string',
            'penguasaan_pengetahuan' => 'nullable|string',
            'aktiv_pres_penghargaan' => 'nullable|string',
            'magang' => 'nullable|string',
            'jenjangpend_syaratbelajar' => 'nullable|string',
            'sks_lamastudi' => 'nullable|numeric',
            'kota' => 'nullable|string',
            'tanggal_skpi' => 'nullable|date',
            'kemampuan_kerja' => 'nullable|string',
            'info_kkni' => 'nullable|string',

            // VALIDASI FILE
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        // ✅ Update data TEXT dulu
        $skpi->update($validated);

        // ✅ Handle file PDF
        if ($request->hasFile('file_pdf')) {

            // (opsional) hapus file lama
            if ($skpi->file_pdf && file_exists(public_path('skpi/' . $skpi->file_pdf))) {
                unlink(public_path('skpi/' . $skpi->file_pdf));
            }

            $file = $request->file('file_pdf');
            $nama = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('skpi'), $nama);

            $skpi->update([
                'file_pdf' => $nama
            ]);
        }

        return redirect()
            ->route('viewmahasiswa.skpi')
            ->with('success_swal', true);
    }


    public function listSkpi(Request $request)
    {
        $tahun = session('tahun_filter');

        $tahunList = Mahasiswa::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $query = Skpi::with('mahasiswa')->orderBy('id_skpi', 'desc');

        // filter nim
        if ($request->filled('nim')) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('nim', 'like', '%' . $request->nim . '%');
            });
        }

        // filter tahun
        if ($tahun) {
            $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        }

        $data = $query->get();

        return view('viewmahasiswa.skpi', compact('data', 'tahun', 'tahunList'));
    }

    public function destroy($id)
    {
        $skpi = Skpi::find($id);
        if ($skpi) {
            $skpi->delete();
        }

        return redirect()
            ->route('viewmahasiswa.skpi')
            ->with('success_swal', true);
    }


    // Tambahkan method ini di SkpiController.php

/**
 * Tampilkan halaman print SKPI
 */
public function print($id)
{
    // Ambil data SKPI beserta relasi mahasiswa
    $data = Skpi::with('mahasiswa')->findOrFail($id);
    
    // Return view print
    return view('skpi.print', compact('data'));
}
}
