<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Skpi;
use App\Models\Toga;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DaftarWisuda;


class DaftarWisudaController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

    // ✅ Kalau belum ada profil, redirect ke halaman edit profil + popup warning
    if (!$mahasiswa) {
        return redirect()->route('profil_mahasiswa.store')
            ->with('warning_swal', true);
    }

    $tahun = session('tahun_filter');

    $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
        ->when($tahun, function ($query, $tahun) {
            return $query->whereHas('mahasiswa', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        })
        ->orderBy('id_pendaftaran', 'desc')
        ->get();

    $terdaftar = PendaftaranWisuda::pluck('id_mahasiswa')->toArray();

    // ✅ Aman karena $mahasiswa sudah pasti tidak null di sini
    $latest = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
        ->orderBy('id_pendaftaran', 'desc')
        ->first();

    return view('daftar_wisuda', compact('user', 'mahasiswa', 'data', 'terdaftar', 'tahun', 'latest'));
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

    public function listWisuda5()
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

        return view('layouts5.validation_csdl', compact('data', 'tahun'));
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
            'judul_skripsi'   => 'required|string',
            'ipk'             => 'required|numeric|min:0|max:4',
        ]);

        $cek = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar untuk wisuda.');
        }

        // ================= SIMPAN PENDAFTARAN =================
        $pendaftaran = PendaftaranWisuda::create([
    'id_mahasiswa'        => $mahasiswa->id_mahasiswa,
    'tgl_pendaftaran'     => $request->tgl_pendaftaran,
    'tgl_perkiraan_wisuda'=> $request->tgl_perkiraan_wisuda,
    'status_pendaftaran'  => 'pending',
    'judul_skripsi'       => $request->judul_skripsi,
    'ipk'                 => $request->ipk,
    'no_hp'               => $request->no_hp,   // ← tambah ini
    'email'               => $request->email,   // ← tambah ini
]);

        $idPendaftaran = $pendaftaran->id_pendaftaran;

        // ================= SIMPAN TOGA =================
        Toga::create([
            'id_pendaftaran' => $idPendaftaran,
            'ukuran'         => $request->ukuran,
            'catatan'        => $request->catatan ?? null,
            'status_list'    => 0, // kolom ada di model → default
        ]);

        return redirect()
    ->route('daftar_wisuda.index')  // ← ganti ke sini
    ->with('success_swal', true);
    }


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
        ]);

        return redirect()
    ->route('daftar_wisuda.index')
    ->with('success_swal', true);
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

        ]);

        return redirect()->route('daftar_wisuda.index')
            ->with('success', 'Pendaftaran wisuda & data toga successfully saved!');
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

        ]);

        return redirect()->route('daftar_wisuda.index')
            ->with('success', 'Pendaftaran wisuda & data toga successfully saved!');
    }

    public function store5(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Profil mahasiswa belum lengkap.');
        }

        $request->validate([
            'tgl_pendaftaran' => 'required|date',
            'ukuran'          => 'required|string|max:10',

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

        ]);

        return redirect()->route('daftar_wisuda.index')
            ->with('success', 'Pendaftaran wisuda & data toga successfully saved!');
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

        return redirect()
            ->route('viewmahasiswa.daftar_wisuda1.wisuda1')
            ->with('success_swal', true);
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
                    return redirect()->back()->with('success', 'Catatan fakultas successfully updated!');

                case 'catatan_perpus':
                    $pendaftaran->catatan_perpus = $request->catatan_perpus;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan perpustakaan successfully updated!');

                case 'catatan_baak':
                    $pendaftaran->catatan_baak = $request->catatan_baak;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan BAAK successfully updated!');

                case 'catatan_finance':
                    $pendaftaran->catatan_finance = $request->catatan_finance;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan finance successfully updated!');

                case 'catatan_csdl':
                    $pendaftaran->catatan_csdl = $request->catatan_csdl;
                    $pendaftaran->save();
                    return redirect()->back()->with('success', 'Catatan CSDL successfully updated!');
            }
        }

        // ✅ Validasi input utama untuk update toga dan tgl_pendaftaran
        $request->validate([
            'tgl_pendaftaran' => 'required|date',
            'ukuran'          => 'required|string|max:10',
            'catatan'         => 'nullable|string',
            'ipk' => 'nullable|numeric|min:0|max:4',             // BARU
            'judul_skripsi' => 'nullable|string',
        ]);

        // Update tanggal pendaftaran
        $pendaftaran->update([
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'ipk' => $request->ipk,               // BARU
            'judul_skripsi' => $request->judul_skripsi,  // BARU
        ]);

        // Update toga
        $toga = $pendaftaran->toga;
        if ($toga) {
            $dataToga = [
                'ukuran'  => $request->ukuran,
                'catatan' => $request->catatan,
            ];

            $toga->update($dataToga);
        }

        return redirect()->back()->with('success', 'Data wisuda successfully updated!');
    }

    public function validasi(Request $request, $id)
    {
        $pendaftaran = PendaftaranWisuda::findOrFail($id);
        $role = auth()->user()->role;

        if ($role == 'finance') {
            $pendaftaran->is_valid_finance = 1;
        } elseif ($role == 'perpustakaan') {
            $pendaftaran->is_valid_perpus = 1;
        } elseif ($role == 'csdl') {
            $pendaftaran->is_valid_csdl = 1;
        } elseif ($role == 'fakultas') {
            $pendaftaran->is_valid_fakultas = 1;

            $pendaftaran->status_pendaftaran = 'disetujui';
        } elseif ($role == 'baak') {
            if ($pendaftaran->is_valid_finance && $pendaftaran->is_valid_perpus && $pendaftaran->is_valid_csdl && $pendaftaran->is_valid_fakultas) {
                $pendaftaran->is_valid_baak = 1;
            } else {
                return redirect()->back()->with('error', 'Semua departemen harus validasi dulu sebelum BAAK!');
            }
        }

        $pendaftaran->save();
        return redirect()->back()->with('success', 'Data successfully validated');
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
                'is_valid_csdl',
                'is_valid_baak'
            ];

            if (in_array($field, $allowedFields)) {
                // Update value checkbox
                $pendaftaran->$field = $request->has($field) ? 1 : 0;
                $pendaftaran->save();

                if (
                    $pendaftaran->is_valid_finance &&
                    $pendaftaran->is_valid_perpus &&
                    $pendaftaran->is_valid_fakultas &&
                    $pendaftaran->is_valid_csdl &&
                    $pendaftaran->is_valid_baak
                ) {
                    $pendaftaran->status_pendaftaran = 'disetujui';
                } else {
                    $pendaftaran->status_pendaftaran = 'pending';
                }

                $pendaftaran->save();

                return back()->with('success', ucfirst(str_replace('_', ' ', $field)) . ' updated successfully');
            }

            return back()->with('error', 'Field tidak valid!');
        }

        return back()->with('error', 'Tidak ada field yang dipilih untuk diperbarui');
    }

    public function pending5()
    {
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->where('is_valid_csdl', 0)   // hanya yang belum diceklis perpustakaan
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('layouts5.pending', compact('data'));
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
                } elseif ($filter === 'perpus') {
                    $q->where('is_valid_csdl', 0);
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
            ->when($tahun, fn($q) => $q->whereHas('mahasiswa', fn($q2) => $q2->where('tahun', $tahun)))
            ->whereHas('toga', fn($q) => $q->whereIn('status_list', [0, 1]))
            ->where('is_valid_finance', 1)
            ->where('is_valid_perpus', 1)
            ->where('is_valid_fakultas', 1)
            ->where('is_valid_csdl', 1)
            ->where('is_valid_baak', 1)
            ->when($filter, function ($q) use ($filter) {
                if ($filter === 'finance') $q->where('is_valid_finance', 1);
                elseif ($filter === 'perpus') $q->where('is_valid_perpus', 1);
                elseif ($filter === 'fakultas') $q->where('is_valid_fakultas', 1);
                elseif ($filter === 'fakultas') $q->where('is_valid_csdl', 1);
                elseif ($filter === 'baak') $q->where('is_valid_baak', 1);
            })
            ->orderBy('id_pendaftaran', 'desc')
            ->get();


        $tahunList = Mahasiswa::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('viewmahasiswa.selesai', compact('data', 'tahun', 'tahunList', 'filter'));
    }

    public function selesaiToga()
    {
        // Ambil semua pendaftaran wisuda yang status toga sudah selesai
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])
            ->whereHas('toga', fn($q) => $q->where('status_list', 1))
            ->orderBy('id_pendaftaran', 'desc')
            ->get();

        return view('viewmahasiswa.togaselesai', compact('data'));
    }

    public function print($id)
    {
        $data = PendaftaranWisuda::with(['mahasiswa', 'toga'])->findOrFail($id);

        return Pdf::loadView('viewmahasiswa.wisuda1_print', compact('data'))
            ->setPaper('A4', 'portrait')
            ->stream();
    }

    public function updateStatusList($id, Request $request)
    {
        // Debug: log ID yang diterima
        \Log::info('Update Status List ID:', ['id' => $id, 'value' => $request->value]);

        // Coba cari berdasarkan id_pengambilan
        $toga = \App\Models\Toga::find($id);

        // Jika tidak ditemukan, cari berdasarkan id_pendaftaran
        if (!$toga) {
            $toga = \App\Models\Toga::where('id_pendaftaran', $id)->first();
        }

        if (!$toga) {
            \Log::error('Data toga not found for ID:', ['id' => $id]);
            return response()->json([
                'error' => 'Data toga not found',
                'debug_id' => $id
            ], 404);
        }

        $toga->status_list = $request->value == 1 ? 1 : 0;
        $toga->save();

        \Log::info('Status list successfully updated:', [
            'id_pengambilan' => $toga->id_pengambilan,
            'id_pendaftaran' => $toga->id_pendaftaran,
            'status_list' => $toga->status_list
        ]);

        return response()->json([
            'success' => 'Status list successfully updated',
            'status' => $toga->status_list
        ]);
    }
}
