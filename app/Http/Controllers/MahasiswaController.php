<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Skpi;

class MahasiswaController extends Controller
{
    // 📄 Daftar mahasiswa (untuk admin)
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

        $data = PendaftaranWisuda::with('mahasiswa', 'toga')
            ->when($tahun, function ($query, $tahun) {
                $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                    $q->where('tahun', $tahun);
                });
            })
            ->get();

        return view('viewmahasiswa.profil_mahasiswa', compact('mahasiswa', 'tahunList', 'tahun', 'wisuda', 'skpi'));
    }

    // 🟢 Tampilkan profil mahasiswa (user)

    public function show()
    {
        $user = Auth::user();

        // Ambil data mahasiswa berdasarkan username yang login
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        $pendaftaran = null;
        $hasCatatan = false;

        if ($mahasiswa) {
            // Pastikan hanya ambil pendaftaran kalau mahasiswa ada
            $pendaftaran = \App\Models\PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->latest()
                ->first();

            if (
                $pendaftaran &&
                ($pendaftaran->catatan_fakultas ||
                    $pendaftaran->catatan_perpus ||
                    $pendaftaran->catatan_baak ||
                    $pendaftaran->catatan_finance)
            ) {
                $hasCatatan = true;
            }
        }

        // $mahasiswa bisa null, blade nanti handle tampilannya
        return view('profil_mahasiswa', compact('user', 'mahasiswa', 'pendaftaran', 'hasCatatan'));
    }


    // 🟡 EDIT untuk ADMIN
    public function edit($nim = null)
    {
        // admin bisa mengedit data siapa saja
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            $mahasiswa = new Mahasiswa(['nim' => $nim]);
        }

        return view('viewmahasiswa.edit_mahasiswa_admin', compact('mahasiswa'));
    }

    // 🟡 EDIT PROFIL (untuk USER yang login)
    public function editProfilUser()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        if (!$mahasiswa) {
            $mahasiswa = new Mahasiswa(['nim' => $user->username]);
        }

        return view('edit_profil', compact('user', 'mahasiswa'));
    }

    // 🔵 Simpan atau update profil (POST)
    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'fakultas'       => 'required|string|max:255',
            'prodi'          => 'required|string|max:255',
            'tahun'          => 'required|integer',
        ]);

        $user = Auth::user();

        Mahasiswa::updateOrCreate(
            ['nim' => $user->username],
            [
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'fakultas'       => $request->fakultas,
                'prodi'          => $request->prodi,
                'tahun'          => $request->tahun,
            ]
        );

        return redirect()->route('profil_mahasiswa.show')->with('success', 'Profil mahasiswa berhasil diperbarui!');
    }

    // 🔴 Hapus data mahasiswa (admin)
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if ($mahasiswa) {
            $mahasiswa->delete();
        }
        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
