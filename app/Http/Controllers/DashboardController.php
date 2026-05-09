<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
        // SEMUA BAGIAN SUDAH SELESAI (Semua 1)
        $wisudaSelesai = PendaftaranWisuda::where('is_valid_baak', 1)
            ->where('is_valid_finance', 1)
            ->where('is_valid_perpus', 1)
            ->where('is_valid_fakultas', 1)
            ->where('is_valid_csdl', 1) // Added CSDL
            ->count();

        // BELUM SELESAI (ADA YANG 0)
        $wisudaBelum = PendaftaranWisuda::where(function ($query) {
            $query->where('is_valid_baak', 0)
                ->orWhere('is_valid_finance', 0)
                ->orWhere('is_valid_perpus', 0)
                ->orWhere('is_valid_fakultas', 0)
                ->orWhere('is_valid_csdl', 0); // Added CSDL
        })->count();

        $jumlahSkpi = Skpi::count();
        $jumlahMahasiswa = Mahasiswa::count();

        // Toga sudah diambil (Status 1)
        $togaDiambil = Toga::where('status_list', 1)->count();

        // Data mahasiswa per fakultas
        $mahasiswaPerFakultas = Mahasiswa::select('fakultas', DB::raw('count(*) as total'))
            ->groupBy('fakultas')
            ->orderBy('total', 'desc')
            ->get();

        // Pendaftaran baru (7 hari terakhir) yang masih belum selesai
        $pendaftaranBaru = PendaftaranWisuda::with('mahasiswa')
            ->where('created_at', '>=', now()->subDays(7)) // 7 Hari Terakhir
            ->where(function ($query) {
                $query->where('is_valid_baak', 0)
                    ->orWhere('is_valid_finance', 0)
                    ->orWhere('is_valid_perpus', 0)
                    ->orWhere('is_valid_fakultas', 0)
                    ->orWhere('is_valid_csdl', 0);
            })
            ->orderBy('created_at', 'desc')
            ->get();


        return view('dashboard.dashboard', compact(
            'wisudaSelesai',
            'wisudaBelum',
            'jumlahSkpi',
            'jumlahMahasiswa',
            'togaDiambil',
            'mahasiswaPerFakultas',
            'pendaftaranBaru'
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

    public function index5()
    {
        // DASHBOARD FAKULTAS
        $wisudaSelesai = PendaftaranWisuda::where('is_valid_csdl', 1)->count();
        $wisudaBelum   = PendaftaranWisuda::where('is_valid_csdl', 0)->count();

        $jumlahSkpi = Skpi::count();
        $jumlahMahasiswa = Mahasiswa::count();
        $togaDiambil = Toga::where('status_list', 'Sudah Diambil')->count();

        $mahasiswaPerFakultas = Mahasiswa::select('fakultas', DB::raw('count(*) as total'))
            ->groupBy('fakultas')
            ->orderBy('total', 'desc')
            ->get();

        $pendaftaranBaru = PendaftaranWisuda::with('mahasiswa')
            ->where('is_valid_csdl', 0)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('layouts5.dashboard', compact(
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

        return redirect()->back()->with('success', 'Profile photo updated successfully!');
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

        return redirect()->back()->with('success', 'Password has been successfully changed!');
    }

    public function adminDashboard2()
{
    $admin = Auth::user();
 
    $passwordHint = '';
    if (!empty($admin->password_hint_last_char)) {
        $passwordHint = $admin->password_hint_last_char;
    }
 
    return view('layouts2.profiladmin', compact('admin', 'passwordHint'));
}
 
public function updateFoto2(Request $request)
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
 
    return redirect()->back()->with('success', 'Profile photo successfully updated!');
}
 
public function updatePassword2(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*#?&]/',
            'confirmed',
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
 
    if (Schema::hasColumn('users', 'password_hint_last_char')) {
        $user->password_hint_last_char = substr($request->new_password, -1);
    }
 
    $user->save();
 
    return redirect()->back()->with('success', 'Password successfully changed!');
}

    public function store(Request $request)
{
    Informasi::create([
        'lokasi'           => $request->lokasi,
        'jumlah_wisudawan' => $request->jumlah_wisudawan,
        'mahasiswa_aktif'  => $request->mahasiswa_aktif,  // ← ini
        'calon_lulusan'    => $request->calon_lulusan,    // ← ini
        'jadwal_wisuda'    => $request->jadwal_wisuda,
        'informasi_baak'   => $request->informasi_baak,
    ]);

    return redirect()->back()->with('success_swal', true);
}

public function update(Request $request, $id)
{
    $info = Informasi::findOrFail($id);
    $info->update([
        'lokasi'           => $request->lokasi,
        'jumlah_wisudawan' => $request->jumlah_wisudawan,
        'mahasiswa_aktif'  => $request->mahasiswa_aktif,  // ← ini
        'calon_lulusan'    => $request->calon_lulusan,    // ← ini
        'jadwal_wisuda'    => $request->jadwal_wisuda,
        'informasi_baak'   => $request->informasi_baak,
    ]);

    return redirect()->back()->with('success1_swal', true);
}

public function destroy($id)
{
    Informasi::findOrFail($id)->delete();
    return redirect()->back()->with('success3_swal', true);
}

    // public function index2()
    // {
    //     return view('layouts2.dashboard');
    // }

    // public function index3()
    // {
    //     return view('layouts3.dashboard');
    // }

    // public function index4()
    // {
    //     return view('layouts4.dashboard');
    // }

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

        return redirect()->back()->with('success', 'Status successfully updated!');
    }
}
