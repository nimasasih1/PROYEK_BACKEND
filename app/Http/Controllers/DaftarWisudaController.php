<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Skpi;
use App\Models\Toga;
use Illuminate\Http\Request;

class DaftarWisudaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        $tahun = session('tahun_filter'); // ambil filter tahun dari session

        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->when($tahun, function ($query, $tahun) {
                return $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                    $q->where('tahun', $tahun);
                });
            })
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        $terdaftar = PendaftaranWisuda::pluck('id_mahasiswa')->toArray();

        return view('daftar_wisuda', compact('user', 'mahasiswa', 'data', 'terdaftar', 'tahun'));
    }

    public function listWisuda()
    {
        $tahun = session('tahun_filter');

        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->when($tahun, function ($query, $tahun) {
                return $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                    $q->where('tahun', $tahun);
                });
            })
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('viewmahasiswa.daftar_wisuda1', compact('data', 'tahun'));
    }

    public function listWisuda2()
    {
        $tahun = session('tahun_filter');

        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->when($tahun, function ($query, $tahun) {
                return $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                    $q->where('tahun', $tahun);
                });
            })
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('layouts2.validation_finance', compact('data', 'tahun'));
    }

    public function listWisuda3()
    {
        $tahun = session('tahun_filter');

        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->when($tahun, function ($query, $tahun) {
                return $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                    $q->where('tahun', $tahun);
                });
            })
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('layouts3.validation_perpus', compact('data', 'tahun'));
    }

    public function listWisuda4()
    {
        $tahun = session('tahun_filter');

        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->when($tahun, function ($query, $tahun) {
                return $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                    $q->where('tahun', $tahun);
                });
            })
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('layouts4.validation_faculty', compact('data', 'tahun'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Profil mahasiswa belum lengkap.');
        }

        $request->validate([
            'tgl_pendaftaran' => 'required|date',
            'ukuran'          => 'required|string|max:10',
            'ttd'             => 'required|string',
        ]);

        $cek = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar untuk wisuda.');
        }

        $pendaftaran = PendaftaranWisuda::create([
            'id_mahasiswa'    => $mahasiswa->id_mahasiswa,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'status_pendaftaran' => 'pending',
        ]);

        Toga::create([
            'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            'ukuran'         => $request->ukuran,
            'catatan'        => $request->catatan,
            'ttd'            => $request->ttd,
        ]);

        return redirect()->route('daftar_wisuda.index')
            ->with('success', 'Pendaftaran wisuda & data toga berhasil disimpan!');
    }

    // store2, store3, store4 tetap sama (duplikat) hanya ditambahkan status_pendaftaran default 'pending'
    public function store2(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Profil mahasiswa belum lengkap.');
        }

        $request->validate([
            'tgl_pendaftaran' => 'required|date',
            'ukuran'          => 'required|string|max:10',
            'ttd'             => 'required|string',
        ]);

        $cek = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar untuk wisuda.');
        }

        $pendaftaran = PendaftaranWisuda::create([
            'id_mahasiswa'    => $mahasiswa->id_mahasiswa,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'status_pendaftaran' => 'pending',
        ]);

        Toga::create([
            'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            'ukuran'         => $request->ukuran,
            'catatan'        => $request->catatan,
            'ttd'            => $request->ttd,
        ]);

        return redirect()->route('daftar_wisuda.index')
            ->with('success', 'Pendaftaran wisuda & data toga berhasil disimpan!');
    }

    public function store3(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Profil mahasiswa belum lengkap.');
        }

        $request->validate([
            'tgl_pendaftaran' => 'required|date',
            'ukuran'          => 'required|string|max:10',
            'ttd'             => 'required|string',
        ]);

        $cek = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar untuk wisuda.');
        }

        $pendaftaran = PendaftaranWisuda::create([
            'id_mahasiswa'    => $mahasiswa->id_mahasiswa,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'status_pendaftaran' => 'pending',
        ]);

        Toga::create([
            'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            'ukuran'         => $request->ukuran,
            'catatan'        => $request->catatan,
            'ttd'            => $request->ttd,
        ]);

        return redirect()->route('daftar_wisuda.index')
            ->with('success', 'Pendaftaran wisuda & data toga berhasil disimpan!');
    }

    public function store4(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Profil mahasiswa belum lengkap.');
        }

        $request->validate([
            'tgl_pendaftaran' => 'required|date',
            'ukuran'          => 'required|string|max:10',
            'ttd'             => 'required|string',
        ]);

        $cek = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar untuk wisuda.');
        }

        $pendaftaran = PendaftaranWisuda::create([
            'id_mahasiswa'    => $mahasiswa->id_mahasiswa,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'status_pendaftaran' => 'pending',
        ]);

        Toga::create([
            'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            'ukuran'         => $request->ukuran,
            'catatan'        => $request->catatan,
            'ttd'            => $request->ttd,
        ]);

        return redirect()->route('daftar_wisuda.index')
            ->with('success', 'Pendaftaran wisuda & data toga berhasil disimpan!');
    }

    public function destroy($id)
    {
        $wisuda = PendaftaranWisuda::findOrFail($id);

        // Ambil id_pendaftaran
        $idPendaftaran = $wisuda->id_pendaftaran;
        $idMahasiswa   = $wisuda->id_mahasiswa;

        \DB::table('pengambilan')->where('id_pendaftaran', $idPendaftaran)->delete();
        Skpi::where('id_mahasiswa', $idMahasiswa)->delete();
        $wisuda->delete();

        return redirect()->back()->with('success', 'Data wisuda & pengambilan berhasil dihapus!');
    }


    public function update(Request $request, $id)
    {
        $pendaftaran = PendaftaranWisuda::findOrFail($id);

        // ✅ Update catatan fakultas, perpustakaan, BAAK, finance jika dikirim
        if ($request->has('field')) {
            switch ($request->field) {
                case 'catatan_fakultas':
                    $pendaftaran->catatan_fakultas = $request->catatan_fakultas;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan fakultas berhasil diperbarui!');

                case 'catatan_perpus':
                    $pendaftaran->catatan_perpus = $request->catatan_perpus;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan perpustakaan berhasil diperbarui!');

                case 'catatan_baak':
                    $pendaftaran->catatan_baak = $request->catatan_baak;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan BAAK berhasil diperbarui!');

                case 'catatan_finance':
                    $pendaftaran->catatan_finance = $request->catatan_finance;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan finance berhasil diperbarui!');
            }
        }

        // ✅ Validasi input utama untuk update toga dan tgl_pendaftaran
        $request->validate([
            'tgl_pendaftaran' => 'required|date',
            'ukuran'          => 'required|string|max:10',
            'catatan'         => 'nullable|string',
            'ttd'             => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update tanggal pendaftaran
        $pendaftaran->update([
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
        ]);

        // Update toga
        $toga = $pendaftaran->toga;
        if ($toga) {
            $dataToga = [
                'ukuran'  => $request->ukuran,
                'catatan' => $request->catatan,
            ];

            // Upload ttd jika ada
            if ($request->hasFile('ttd')) {
                $path = $request->file('ttd')->store('ttd', 'public');
                $dataToga['ttd'] = '/storage/' . $path;
            }

            $toga->update($dataToga);
        }

        return redirect()->back()->with('success', 'Data wisuda berhasil diupdate!');
    }

    public function validasi(Request $request, $id)
    {
        $pendaftaran = PendaftaranWisuda::findOrFail($id);
        $role = auth()->user()->role;

        if ($role == 'finance') {
            $pendaftaran->is_valid_finance = 1;
        } elseif ($role == 'perpustakaan') {
            $pendaftaran->is_valid_perpus = 1;
        } elseif ($role == 'fakultas') {
            $pendaftaran->is_valid_fakultas = 1;

            // ✅ langsung ubah status ke selesai walau yg lain belum
            $pendaftaran->status_pendaftaran = 'disetujui';
        } elseif ($role == 'baak') {
            if ($pendaftaran->is_valid_finance && $pendaftaran->is_valid_perpus && $pendaftaran->is_valid_fakultas) {
                $pendaftaran->is_valid_baak = 1;
            } else {
                return redirect()->back()->with('error', 'Semua departemen harus validasi dulu sebelum BAAK!');
            }
        }

        $pendaftaran->save();
        return redirect()->back()->with('success', 'Data berhasil divalidasi');
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = PendaftaranWisuda::findOrFail($id);

        if ($request->has('field')) {
            $field = $request->field;

            $allowedFields = [
                'is_valid_finance',
                'is_valid_perpus',
                'is_valid_fakultas',
                'is_valid_baak'
            ];

            if (in_array($field, $allowedFields)) {
                // Update value checkbox
                $pendaftaran->$field = $request->has($field) ? 1 : 0;
                $pendaftaran->save();

                // ✅ Cek apakah semua sudah divalidasi
                if (
                    $pendaftaran->is_valid_finance &&
                    $pendaftaran->is_valid_perpus &&
                    $pendaftaran->is_valid_fakultas &&
                    $pendaftaran->is_valid_baak
                ) {
                    $pendaftaran->status_pendaftaran = 'disetujui';
                } else {
                    $pendaftaran->status_pendaftaran = 'pending';
                }

                $pendaftaran->save();

                return back()->with('success', ucfirst(str_replace('_', ' ', $field)) . ' berhasil diperbarui');
            }

            return back()->with('error', 'Field tidak valid!');
        }

        return back()->with('error', 'Tidak ada field yang dipilih untuk diperbarui');
    }

    public function pending4()
    {
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->where('is_valid_fakultas', 0)   // hanya yang belum diceklis perpustakaan
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('layouts4.pending', compact('data'));
    }


    public function pending3()
    {
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->where('is_valid_perpus', 0)   // hanya yang belum diceklis perpustakaan
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('layouts3.pending', compact('data'));
    }

    public function pending2()
    {
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->where('is_valid_finance', 0)   // hanya yang belum diceklis perpustakaan
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('layouts2.pending', compact('data'));
    }

    public function pending(Request $request)
    {
        $tahun = session('tahun_filter'); // ambil dari session
        $filter = $request->get('filter'); // ambil filter dari query string

        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->when($tahun, function ($q) use ($tahun) {
                $q->whereHas('mahasiswa', function ($q2) use ($tahun) {
                    $q2->where('tahun', $tahun);
                });
            })
            ->when($filter, function ($q) use ($filter) {
                if ($filter === 'finance') {
                    $q->where('is_valid_finance', 0);
                } elseif ($filter === 'perpus') {
                    $q->where('is_valid_perpus', 0);
                } elseif ($filter === 'fakultas') {
                    $q->where('is_valid_fakultas', 0);
                } elseif ($filter === 'baak') {
                    $q->where('is_valid_baak', 0);
                }
            })
            ->where('status_pendaftaran', 'pending')
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        $tahunList = Mahasiswa::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('viewmahasiswa.pending', compact('data', 'tahun', 'tahunList', 'filter'));
    }

    public function selesai(Request $request)
{
    $tahun = session('tahun_filter');
    $filter = $request->get('filter');

    $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
        ->when($tahun, function ($q) use ($tahun) {
            $q->whereHas('mahasiswa', function ($q2) use ($tahun) {
                $q2->where('tahun', $tahun);
            });
        })
        ->where('is_valid_finance', 1)
        ->where('is_valid_perpus', 1)
        ->where('is_valid_fakultas', 1)
        ->where('is_valid_baak', 1) // ✅ filter utama Selesai
        ->when($filter, function ($q) use ($filter) {
            if ($filter === 'finance') {
                $q->where('is_valid_finance', 1);
            } elseif ($filter === 'perpus') {
                $q->where('is_valid_perpus', 1);
            } elseif ($filter === 'fakultas') {
                $q->where('is_valid_fakultas', 1);
            } elseif ($filter === 'baak') {
                $q->where('is_valid_baak', 1);
            }
        })
        ->orderBy('id_pendaftaran', 'desc')
        ->get();

    $tahunList = Mahasiswa::select('tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    return view('viewmahasiswa.selesai', compact('data', 'tahun', 'tahunList', 'filter'));
}

}
