<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Skpi;
use Illuminate\Support\Facades\Storage;

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

        return view('viewmahasiswa.profil_mahasiswa', compact('mahasiswa', 'tahunList', 'tahun', 'wisuda', 'skpi', 'data'));
    }

    // 🟢 Tampilkan profil mahasiswa (user)
    public function show()
    {
        $user = Auth::user();

        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

        $pendaftaran = null;
        $hasCatatan = false;

        if ($mahasiswa) {
            $pendaftaran = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
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

        return view('profil_mahasiswa', compact('user', 'mahasiswa', 'pendaftaran', 'hasCatatan'));
    }

    // 🟡 EDIT untuk ADMIN
    public function edit($nim = null)
    {
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
        // 1. Validasi data
        $validatedData = $request->validate([
            'nim'            => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:255',
            'fakultas'       => 'required|string|max:255',
            'prodi'          => 'required|string|max:255',
            'tahun'          => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'jenjang'        => 'required|string|max:50',
            'no_telp'        => 'nullable|string|max:20',
            'email'          => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/', 'max:255'],
            'alamat'         => 'nullable|string|max:500',
            'tempat_lahir'   => 'nullable|string|max:50',
            'tanggal_lahir'  => 'nullable|date',
            'foto_profil'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nim = $validatedData['nim'];

        // 2. Upload Foto
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');

            if (!$file || !$file->isValid()) {
                return back()->withErrors(['foto_profil' => 'File foto profil tidak valid atau gagal diunggah.'])->withInput();
            }

            $extension = $file->getClientOriginalExtension();
            $fileName = $nim . '.' . $extension;

            // Tentukan path langsung di app/public/profil_mahasiswa
            $destinationPath = public_path('profil_mahasiswa');

            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Hapus foto lama jika ada
            $mahasiswaLama = Mahasiswa::where('nim', $nim)->first();
            if ($mahasiswaLama && !empty($mahasiswaLama->foto_profil)) {
                $oldPath = public_path($mahasiswaLama->foto_profil); // langsung path absolut
                if (file_exists($oldPath) && !empty($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Pindahkan file baru ke folder yang benar
            $file->move($destinationPath, $fileName);

            // Simpan path relatif ke database, misal: 'profil_mahasiswa/nim.jpg'
            $validatedData['foto_profil'] = 'profil_mahasiswa/' . $fileName;
        } else {
            unset($validatedData['foto_profil']);
        }

        // 3. UpdateOrCreate Mahasiswa
        $mahasiswa = Mahasiswa::updateOrCreate(
            ['nim' => $nim],
            $validatedData
        );

        // 4. Redirect sukses
        return redirect()->route('profil_mahasiswa.show')
            ->with('success', 'Profil mahasiswa dengan NIM ' . $mahasiswa->nim . ' berhasil diperbarui!');
    }

    public function update(Request $request, $nim)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'fakultas'       => 'required|string|max:255',
            'prodi'          => 'required|string|max:255',
            'tahun'          => 'required|integer',
            'jenjang'        => 'required|string|max:50',
            'no_telp'        => 'nullable|string|max:20',
            'email'          => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
            'alamat'         => 'nullable|string|max:500',

            // ✔ Ditambahkan agar sesuai tabel
            'tempat_lahir'   => 'nullable|string|max:50',
            'tanggal_lahir'  => 'nullable|date',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'fakultas'       => $request->fakultas,
            'prodi'          => $request->prodi,
            'tahun'          => $request->tahun,
            'jenjang'        => $request->jenjang,
            'no_telp'        => $request->no_telp,
            'email'          => $request->email,
            'alamat'         => $request->alamat,

            // ✔ Sesuai tabel
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
        ]);

        return redirect()
            ->route('viewmahasiswa.profil_mahasiswa.index')
            ->with('success1_swal', true);
    }

    // 🔴 Hapus data mahasiswa (admin)
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if ($mahasiswa) {
            $mahasiswa->delete();
        }

        return redirect()
            ->route('viewmahasiswa.profil_mahasiswa.index')
            ->with('success_swal', true);
    }

    public function indexKesan()
    {
        $kesan = \App\Models\KesanModel::all();
        // Ambil data mahasiswa yang login untuk form tambah
        $user = \Illuminate\Support\Facades\Auth::user();
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $user->username)->first();

        return view('dashboard.kesan_mahasiswa', compact('kesan', 'mahasiswa'));
    }

    // MahasiswaController.php
    public function showKesanJson($id)
    {
        $kesan = \App\Models\KesanModel::findOrFail($id);
        return response()->json($kesan);
    }


    public function storeKesan(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'kesan'   => 'required|string',
            'tanggal' => 'required|date',
        ]);

        \App\Models\KesanModel::create([
            'nama'    => $request->nama,
            'kesan'   => $request->kesan,
            'tanggal' => $request->tanggal,
        ]);

        return back()->with('success', 'Kesan berhasil dikirim!');
    }

    public function editKesan($id)
    {
        $kesan = \App\Models\KesanModel::findOrFail($id);
        return response()->json($kesan);
    }

    // Update Kesan
    public function updateKesan(Request $request, $id)
    {
        $request->validate([
            'kesan'   => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $kesan = \App\Models\KesanModel::findOrFail($id);
        $kesan->update([
            'kesan'   => $request->kesan,
            'tanggal' => $request->tanggal,
        ]);

        return back()->with('success', 'Kesan berhasil diperbarui!');
    }

    // Hapus Kesan
    public function destroyKesan($id)
    {
        $kesan = \App\Models\KesanModel::findOrFail($id);
        $kesan->delete();

        return back()->with('success', 'Kesan berhasil dihapus!');
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
