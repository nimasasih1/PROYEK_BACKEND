<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:mahasiswa,baak,finance,perpustakaan,fakultas',
        ]);

        $username = $request->username;
        $password = Hash::make($request->password);
        $role     = $request->role;

        if ($role == "baak") $username = "" . $username;
        if ($role == "finance")  $username = "" . $username;
        if ($role == "perpustakaan") $username = "" . $username;
        if ($role == "fakultas")  $username = "" . $username;

        DB::table('users')->insert([
            'username' => $username,
            'password' => $password,
            'role'     => $role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
