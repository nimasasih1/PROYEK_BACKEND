<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Toga;
use Illuminate\Http\Request;
use App\Models\Skpi;
use App\Models\Informasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{

    public function index()
    {
        // Hitung total data hanya untuk dashboard admin
        $jumlahProfil = Mahasiswa::count();
        $jumlahWisuda = PendaftaranWisuda::count();
        $jumlahSkpi = Skpi::count();
        $jumlahToga = Toga::count();
        $jumlahPending = PendaftaranWisuda::where('status_pendaftaran', 'pending')->count();
        $jumlahSelesai = PendaftaranWisuda::where('status_pendaftaran', 'selesai')->count();

        // Kirim hanya ke tampilan dashboard admin
        return view('layouts.dashboard', compact(
            'jumlahProfil',
            'jumlahWisuda',
            'jumlahSkpi',
            'jumlahToga',
            'jumlahPending',
            'jumlahSelesai'
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

    public function index2()
    {
        return view('layouts2.dashboard');
    }

    public function index3()
    {
        return view('layouts3.dashboard');
    }

    public function index4()
    {
        return view('layouts4.dashboard');
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
}
