<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Exports\UserTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Mews\Captcha\Facades\Captcha;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
<<<<<<< HEAD
        // Validasi input dengan pesan error custom
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ], [
            'username.required' => 'Username/NIM wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'captcha.required' => 'Captcha wajib diisi!',
            'captcha.captcha' => 'Captcha yang Anda masukkan salah!',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'Username/NIM tidak ditemukan.',
            ])->withInput($request->only('username'));
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.',
            ])->withInput($request->only('username'));
        }

        // Login berhasil
        Auth::login($user);
        $request->session()->regenerate();

        // Arahkan sesuai role
        switch ($user->role) {
            case 'mahasiswa':
                return redirect()->intended('/beranda');
            case 'baak':
                return redirect()->intended('/layouts');
            case 'finance':
                return redirect()->intended('/layouts2');
            case 'perpustakaan':
                return redirect()->intended('/layouts3');
            case 'fakultas':
                return redirect()->intended('/layouts4');
            default:
                return redirect()->intended('/');
        }
=======
        try {
            // Validasi input dengan pesan error custom
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
                'captcha' => 'required|captcha',
            ], [
                'username.required' => 'Username/NIM wajib diisi!',
                'password.required' => 'Password wajib diisi!',
                'captcha.required' => 'Captcha wajib diisi!',
                'captcha.captcha' => 'Captcha yang Anda masukkan salah!',
            ]);

            // Cari user berdasarkan username
            $user = User::where('username', $request->username)->first();

            if (!$user) {
                return back()->withErrors([
                    'username' => 'Username/NIM tidak ditemukan.',
                ])->withInput($request->only('username'));
            }

            // Cek password
            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'password' => 'Password yang Anda masukkan salah.',
                ])->withInput($request->only('username'));
            }

            // Login berhasil
            Auth::login($user);
            $request->session()->regenerate();

            // Arahkan sesuai role
            switch ($user->role) {
                case 'mahasiswa':
                    return redirect()->intended('/beranda');
                case 'baak':
                    return redirect()->intended('/layouts');
                case 'finance':
                    return redirect()->intended('/layouts2');
                case 'perpustakaan':
                    return redirect()->intended('/layouts3');
                case 'fakultas':
                    return redirect()->intended('/layouts4');
                default:
                    return redirect()->intended('/');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Kalo error karena validasi, lempar balik aja biar pesan tetap muncul
            throw $e;
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());

            return back()->withErrors([
                'error' => 'Terjadi kesalahan pada server. Silakan coba lagi nanti 🙏'
            ])->withInput($request->only('username'));
        }
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
    }
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login.form');
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            return redirect()->route('login.form')->with('error', 'Gagal logout, coba lagi ya 😭');
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(
            new UserTemplateExport,
            'template_users.xlsx'
        );
    }

    /**
     * Import users from Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return back()->with('success_swal', 'Users berhasil diimport');
    }

    public function downloadTemplate()
    {
        return Excel::download(
            new UserTemplateExport,
            'template_users.xlsx'
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return back()->with('success_swal', 'Users berhasil diimport');
    }
}