<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Skpi;

class MahasiswaController extends Controller
{

    public function index(Request $request)
    {
        $tahunList = Mahasiswa::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        if ($request->has('tahun')) {
            session(['tahun_filter' => $request->get('tahun')]);
        }

        $tahun = session('tahun_filter');

        $mahasiswa = Mahasiswa::when($tahun, function ($query, $tahun) {
            return $query->where('tahun', $tahun);
        })->get();

        $wisuda = PendaftaranWisuda::with('mahasiswa')
            ->when($tahun, function ($query, $tahun) {
                $query->whereHas('mahasiswa', function ($m) use ($tahun) {
                    $m->where('tahun', $tahun);
                });
            })
            ->get();

        $skpi = Skpi::with('mahasiswa')
            ->when($tahun, function ($query, $tahun) {
                $query->whereHas('mahasiswa', function ($s) use ($tahun) {
                    $s->where('tahun', $tahun);
                });
            })
            ->get();

        return view('viewmahasiswa.profil_mahasiswa', compact('mahasiswa', 'tahunList', 'tahun', 'wisuda', 'skpi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'fakultas'       => 'required|string|max:255',
            'prodi'          => 'required|string|max:255',
            'tahun'          => 'required|integer',
        ]);

        $user = Auth::user();

        // simpan data baru untuk mahasiswa login
        Mahasiswa::create([
            'nim'            => $user->username,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'fakultas'       => $request->fakultas,
            'prodi'          => $request->prodi,
            'tahun'          => $request->tahun,
        ]);

        return redirect()->back()->with('success', 'Profil mahasiswa berhasil disimpan!');
    }

    public function edit()
    {
        $user = Auth::user();

        // Cari mahasiswa berdasarkan nim (username login)
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        // Jika belum ada, buat object kosong agar form tetap bisa diisi
        if (!$mahasiswa) {
            $mahasiswa = new Mahasiswa([
                'nim' => $user->username
            ]);
        }

        return view('profil_mahasiswa', compact('user', 'mahasiswa'));
    }

    public function update(Request $request, $nim)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'fakultas' => $request->fakultas,
            'prodi' => $request->prodi,
            'tahun' => $request->tahun,
        ]);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui!');
    }
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if ($mahasiswa) {
            $mahasiswa->delete();
        }
        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
