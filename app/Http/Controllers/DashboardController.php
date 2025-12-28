<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Toga;
use Illuminate\Http\Request;
use App\Models\Skpi;
use App\Models\Informasi;
use App\Models\MediaWisuda;
use App\Models\Testimoni;
use App\Models\Statistik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{

    public function index()
    {
        // SEMUA BAGIAN SUDAH SELESAI (1 semua)
        $wisudaSelesai = PendaftaranWisuda::where('is_valid_baak', 1)
            ->where('is_valid_finance', 1)
            ->where('is_valid_perpus', 1)
            ->where('is_valid_fakultas', 1)
            ->count();

        // BELUM SELESAI (ADA YANG 0)
        $wisudaBelum = PendaftaranWisuda::where(function ($query) {
            $query->where('is_valid_baak', 0)
                ->orWhere('is_valid_finance', 0)
                ->orWhere('is_valid_perpus', 0)
                ->orWhere('is_valid_fakultas', 0);
        })->count();

        $jumlahSkpi = Skpi::count();
        $jumlahMahasiswa = Mahasiswa::count();

        // Toga sudah diambil
        $togaDiambil = Toga::where('status_list', 'Sudah Diambil')->count();

        // Data mahasiswa per fakultas
        $mahasiswaPerFakultas = Mahasiswa::select('fakultas', DB::raw('count(*) as total'))
            ->groupBy('fakultas')
            ->orderBy('total', 'desc')
            ->get();

        // Pendaftaran baru (7 hari terakhir) yang masih belum selesai
        $pendaftaranBaru = PendaftaranWisuda::with('mahasiswa')
            ->whereDate('created_at', now()->toDateString()) // 🔥 HARI INI SAJA
            ->where(function ($query) {
                $query->where('is_valid_baak', 0)
                    ->orWhere('is_valid_finance', 0)
                    ->orWhere('is_valid_perpus', 0)
                    ->orWhere('is_valid_fakultas', 0);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // ===== TAMBAHAN UNTUK HALAMAN ADMIN INFO WISUDA =====
        $data = Informasi::orderBy('jadwal_wisuda', 'desc')->get();
        $mediaWisuda = MediaWisuda::orderBy('urutan')->get();
        $testimoni = Testimoni::orderBy('urutan')->get();
        $statistik = Statistik::first();

        return view('dashboard.dashboard', compact(
            'wisudaSelesai',
            'wisudaBelum',
            'jumlahSkpi',
            'jumlahMahasiswa',
            'togaDiambil',
            'mahasiswaPerFakultas',
            'pendaftaranBaru',
            'data',
            'mediaWisuda',
            'testimoni',
            'statistik'
        ));
    }

    public function index2()
    {
        // DASHBOARD FINANCE
        $wisudaSelesai = PendaftaranWisuda::where('is_valid_finance', 1)->count();
        $wisudaBelum   = PendaftaranWisuda::where('is_valid_finance', 0)->count();

        $jumlahSkpi = Skpi::count();
        $jumlahMahasiswa = Mahasiswa::count();
        $togaDiambil = Toga::where('status_list', 'Sudah Diambil')->count();

        $mahasiswaPerFakultas = Mahasiswa::select('fakultas', DB::raw('count(*) as total'))
            ->groupBy('fakultas')
            ->orderBy('total', 'desc')
            ->get();

        $pendaftaranBaru = PendaftaranWisuda::with('mahasiswa')
            ->where('is_valid_finance', 0)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('layouts2.dashboard', compact(
            'wisudaSelesai',
            'wisudaBelum',
            'jumlahSkpi',
            'jumlahMahasiswa',
            'togaDiambil',
            'mahasiswaPerFakultas',
            'pendaftaranBaru'
        ));
    }

    public function index3()
    {
        // DASHBOARD PERPUSTAKAAN
        $wisudaSelesai = PendaftaranWisuda::where('is_valid_perpus', 1)->count();
        $wisudaBelum   = PendaftaranWisuda::where('is_valid_perpus', 0)->count();

        $jumlahSkpi = Skpi::count();
        $jumlahMahasiswa = Mahasiswa::count();
        $togaDiambil = Toga::where('status_list', 'Sudah Diambil')->count();

        $mahasiswaPerFakultas = Mahasiswa::select('fakultas', DB::raw('count(*) as total'))
            ->groupBy('fakultas')
            ->orderBy('total', 'desc')
            ->get();

        $pendaftaranBaru = PendaftaranWisuda::with('mahasiswa')
            ->where('is_valid_perpus', 0)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('layouts3.dashboard', compact(
            'wisudaSelesai',
            'wisudaBelum',
            'jumlahSkpi',
            'jumlahMahasiswa',
            'togaDiambil',
            'mahasiswaPerFakultas',
            'pendaftaranBaru'
        ));
    }

    public function index4()
    {
        // DASHBOARD FAKULTAS
        $wisudaSelesai = PendaftaranWisuda::where('is_valid_fakultas', 1)->count();
        $wisudaBelum   = PendaftaranWisuda::where('is_valid_fakultas', 0)->count();

        $jumlahSkpi = Skpi::count();
        $jumlahMahasiswa = Mahasiswa::count();
        $togaDiambil = Toga::where('status_list', 'Sudah Diambil')->count();

        $mahasiswaPerFakultas = Mahasiswa::select('fakultas', DB::raw('count(*) as total'))
            ->groupBy('fakultas')
            ->orderBy('total', 'desc')
            ->get();

        $pendaftaranBaru = PendaftaranWisuda::with('mahasiswa')
            ->where('is_valid_fakultas', 0)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('layouts4.dashboard', compact(
            'wisudaSelesai',
            'wisudaBelum',
            'jumlahSkpi',
            'jumlahMahasiswa',
            'togaDiambil',
            'mahasiswaPerFakultas',
            'pendaftaranBaru'
        ));
    }

    public function adminDashboard()
    {
        $admin = Auth::user();

        // Ambil karakter terakhir password hint jika ada
        $passwordHint = '';
        if (!empty($admin->password_hint_last_char)) {
            $passwordHint = $admin->password_hint_last_char;
        }

        return view('dashboard.profiladmin', compact('admin', 'passwordHint'));
    }

    // Update Foto Profil
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto.required' => 'Foto harus dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $admin = Auth::user();

        if ($request->hasFile('foto')) {
            if (!empty($admin->foto) && file_exists(public_path($admin->foto))) {
                unlink(public_path($admin->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            if (!file_exists(public_path('uploads/profil'))) {
                mkdir(public_path('uploads/profil'), 0755, true);
            }

            $file->move(public_path('uploads/profil'), $filename);
            $admin->foto = 'uploads/profil/' . $filename;
            $admin->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/',      // angka
                'regex:/[@$!%*#?&]/', // simbol
                'confirmed',          // harus sesuai new_password_confirmation
                'different:current_password'
            ],
        ], [
            'current_password.required' => 'Password lama harus diisi.',
            'new_password.required' => 'Password baru harus diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.regex' => 'Password baru harus mengandung huruf besar, huruf kecil, angka, dan simbol (@$!%*#?&).',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
            'new_password.different' => 'Password baru harus berbeda dengan password lama.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.'])
                ->withInput();
        }

        $user->password = Hash::make($request->new_password);

        // Simpan hint karakter terakhir password
        if (Schema::hasColumn('users', 'password_hint_last_char')) {
            $user->password_hint_last_char = substr($request->new_password, -1);
        }

        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }

    public function wisuda1()
    {
        $data = Mahasiswa::with(['pendaftaran.toga'])->get();
        return view('viewmahasiswa.daftar_wisuda1', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $info = Informasi::findOrFail($id);
        $info->status = $request->status;
        $info->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate!');
    }

    // ===============================================
    // 🎯 METHODS BARU UNTUK MEDIA WISUDA
    // ===============================================
    
    public function storeMedia(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:0'
        ], [
            'judul.required' => 'Judul harus diisi.',
            'gambar.required' => 'Gambar harus diunggah.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'urutan.required' => 'Urutan tampil harus diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('media-wisuda', 'public');

            MediaWisuda::create([
                'judul' => $request->judul,
                'gambar' => $path,
                'deskripsi' => $request->deskripsi,
                'urutan' => $request->urutan
            ]);

            return redirect()->back()->with('success_swal', true);
        }

        return redirect()->back()->withErrors(['gambar' => 'Gagal mengupload gambar.']);
    }

    public function updateMedia(Request $request, $id)
    {
        $media = MediaWisuda::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:0'
        ]);

        $media->judul = $request->judul;
        $media->deskripsi = $request->deskripsi;
        $media->urutan = $request->urutan;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($media->gambar && Storage::disk('public')->exists($media->gambar)) {
                Storage::disk('public')->delete($media->gambar);
            }
            
            $path = $request->file('gambar')->store('media-wisuda', 'public');
            $media->gambar = $path;
        }

        $media->save();

        return redirect()->back()->with('success1_swal', true);
    }

    public function destroyMedia($id)
    {
        $media = MediaWisuda::findOrFail($id);
        
        // Hapus file gambar dari storage
        if ($media->gambar && Storage::disk('public')->exists($media->gambar)) {
            Storage::disk('public')->delete($media->gambar);
        }
        
        $media->delete();
        
        return redirect()->back()->with('success3_swal', true);
    }

    // ===============================================
    // 🎯 METHODS BARU UNTUK TESTIMONI
    // ===============================================
    
    public function storeTestimoni(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_lulus' => 'required|string|max:4',
            'testimoni' => 'required|string',
            'urutan' => 'required|integer|min:0'
        ], [
            'nama.required' => 'Nama alumni harus diisi.',
            'tahun_lulus.required' => 'Tahun lulus harus diisi.',
            'testimoni.required' => 'Testimoni harus diisi.',
            'urutan.required' => 'Urutan tampil harus diisi.'
        ]);

        Testimoni::create($request->all());
        
        return redirect()->back()->with('success_swal', true);
    }

    public function updateTestimoni(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_lulus' => 'required|string|max:4',
            'testimoni' => 'required|string',
            'urutan' => 'required|integer|min:0'
        ]);

        $testimoni->update($request->all());
        
        return redirect()->back()->with('success1_swal', true);
    }

    public function destroyTestimoni($id)
    {
        Testimoni::findOrFail($id)->delete();
        
        return redirect()->back()->with('success3_swal', true);
    }

    // ===============================================
    // 🎯 METHODS BARU UNTUK STATISTIK
    // ===============================================
    
    public function updateStatistik(Request $request)
    {
        $request->validate([
            'total_lulusan' => 'required|integer|min:0',
            'mahasiswa_aktif' => 'required|integer|min:0',
            'calon_lulusan' => 'required|integer|min:0'
        ], [
            'total_lulusan.required' => 'Total lulusan harus diisi.',
            'total_lulusan.integer' => 'Total lulusan harus berupa angka.',
            'mahasiswa_aktif.required' => 'Mahasiswa aktif harus diisi.',
            'mahasiswa_aktif.integer' => 'Mahasiswa aktif harus berupa angka.',
            'calon_lulusan.required' => 'Calon lulusan harus diisi.',
            'calon_lulusan.integer' => 'Calon lulusan harus berupa angka.'
        ]);

        $statistik = Statistik::first();
        
        if ($statistik) {
            $statistik->update($request->all());
        } else {
            Statistik::create($request->all());
        }
        
        return redirect()->back()->with('success1_swal', true);
    }
}