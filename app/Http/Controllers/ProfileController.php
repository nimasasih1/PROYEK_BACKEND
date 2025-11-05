<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Update profil pengguna
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,'.$user->id,
            'password' => 'nullable|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Update field dasar
        $user->name = $request->name;
        $user->username = $request->username;

        // Jika ada password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Jika ada avatar di-upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/avatar'), $filename);
            $user->avatar = 'uploads/avatar/'.$filename;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
