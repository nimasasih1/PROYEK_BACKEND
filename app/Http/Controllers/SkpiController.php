<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skpi;
use App\Models\Mahasiswa;

class SkpiController extends Controller
{
    public function create()
    {
        $user = auth()->user(); // ambil user login
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first(); // ambil data mahasiswa login

        // jika mahasiswa tidak ditemukan, redirect atau tampilkan pesan error
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
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first(); // ambil mahasiswa login

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $request->validate([
            'tgl_pengajuan_mahasiswa' => 'required|date',
            'jenjang_mahasiswa' => 'required|string|max:50',
            'no_hp_mahasiswa' => 'required|string|max:20',
            'email_mahasiswa' => 'required|email|max:100',
            'alamat_mahasiswa' => 'required|string',
            'ttd_mahasiswa' => 'required',
        ]);

        Skpi::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa, // foreign key ke mahasiswa
            'tgl_pengajuan_mahasiswa' => $request->tgl_pengajuan_mahasiswa,
            'jenjang_mahasiswa' => $request->jenjang_mahasiswa,
            'no_hp_mahasiswa' => $request->no_hp_mahasiswa,
            'email_mahasiswa' => $request->email_mahasiswa,
            'alamat_mahasiswa' => $request->alamat_mahasiswa,
            'ttd_mahasiswa' => $request->ttd_mahasiswa,
            'status_skpi' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan SKPI berhasil dikirim!');
    }

    public function update(Request $request, $id)
    {
        $skpi = Skpi::findOrFail($id);

        $request->validate([
            'tgl_pengajuan_mahasiswa' => 'required|date',
            'jenjang_mahasiswa' => 'required|string|max:50',
            'no_hp_mahasiswa' => 'required|string|max:20',
            'email_mahasiswa' => 'required|email|max:100',
            'alamat_mahasiswa' => 'required|string',
        ]);

        $skpi->update([
            'tgl_pengajuan_mahasiswa' => $request->tgl_pengajuan_mahasiswa,
            'jenjang_mahasiswa' => $request->jenjang_mahasiswa,
            'no_hp_mahasiswa' => $request->no_hp_mahasiswa,
            'email_mahasiswa' => $request->email_mahasiswa,
            'alamat_mahasiswa' => $request->alamat_mahasiswa,
        ]);

        return redirect()->back()->with('success', 'Data SKPI berhasil diperbarui!');
    }

    public function listSkpi(Request $request)
    {
        // ambil filter tahun dari session
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

        // filter tahun (menggunakan session, sama dengan pending)
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
        return redirect()->back()->with('success', 'Data SKPI berhasil dihapus!');
    }
}
