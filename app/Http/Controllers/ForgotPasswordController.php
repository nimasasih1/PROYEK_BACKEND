<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // Step 1: Kirim OTP ke email
    public function requestOtp(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'send_to'  => 'required|email',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan.');
        }

        // Ambil email dari tabel users, atau dari tabel mahasiswa jika rolenya mahasiswa
        $email = $user->email;
        if (empty($email) && $user->role === 'mahasiswa') {
            $mahasiswa = \App\Models\Mahasiswa::where('nim', $user->username)->first();
            if ($mahasiswa) {
                $email = $mahasiswa->email;
            }
        }

        // Jika email masih kosong
        if (empty($email)) {
            return back()->with('error', 'Email belum terdaftar di sistem untuk user ini.');
        }

        // Cek apakah email cocok
        if ($email !== $request->send_to) {
            return back()->with('error', 'Email tidak sesuai dengan username.');
        }

        // Generate OTP 6 digit
        $otp = rand(100000, 999999);

        // Simpan OTP ke database (tabel password_reset_tokens)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token'      => $otp,
                'created_at' => Carbon::now(),
            ]
        );

        // Kirim OTP via email
        Mail::raw("Kode OTP reset password kamu adalah: $otp\n\nKode ini berlaku selama 5 menit.", function ($message) use ($email) {
            $message->to($email)
                    ->subject('Kode OTP Reset Password');
        });

        return redirect()->route('forgot.resetForm')->with('success', 'Kode OTP telah dikirim ke email kamu!')->with('username', $request->username);
    }

    // Step 2: Reset password dengan OTP
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username'                  => 'required',
            'otp_code'                  => 'required',
            'new_password'              => 'required|min:8|confirmed',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan.');
        }

        // Ambil email aktual
        $email = $user->email;
        if (empty($email) && $user->role === 'mahasiswa') {
            $mahasiswa = \App\Models\Mahasiswa::where('nim', $user->username)->first();
            if ($mahasiswa) {
                $email = $mahasiswa->email;
            }
        }

        if (empty($email)) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Cek OTP
        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $request->otp_code)
            ->first();

        if (!$record) {
            return back()->with('error', 'Kode OTP salah.');
        }

        // Cek apakah OTP expired (5 menit)
        $createdAt = Carbon::parse($record->created_at);
        if (Carbon::now()->diffInMinutes($createdAt) > 5) {
            return back()->with('error', 'Kode OTP sudah kadaluarsa. Silakan minta kode baru.');
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Hapus OTP dari database
        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->delete();

        return redirect()->route('login.form')->with('success', 'Password berhasil direset! Silakan login.');
    }
}