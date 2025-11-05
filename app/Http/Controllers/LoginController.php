<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha; // ← tambahkan ini

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // resources/views/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha', // ← validasi captcha
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = Auth::user();

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
            }
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}
