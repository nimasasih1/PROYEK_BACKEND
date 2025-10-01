<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Form request OTP
    public function requestOtpForm()
    {
        return view('auth.passwords.request_otp');
    }

    // Generate dan kirim OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
        ]);

        $username = $request->username;

        // ambil email pengirim aktif
        $emailAccount = DB::table('email_accounts')->where('is_active', true)->first();
        if (!$emailAccount) {
            return back()->with('error', 'Tidak ada email pengirim aktif.');
        }

        // generate OTP
        $otp = rand(100000, 999999);

        // simpan ke tabel password_otps
        DB::table('password_otps')->insert([
            'username'   => $username,
            'otp_code'   => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // kirim email (siswa masukkan email yang sama, sistem hanya perantara)
        Mail::raw("Kode OTP reset password Anda adalah: $otp", function ($message) use ($emailAccount, $username) {
            $message->from($emailAccount->email, 'Sistem Reset Password');
            $message->to($emailAccount->email); // semua siswa pakai email sama
            $message->subject("OTP Reset Password untuk $username");
        });

        return back()->with('success', 'OTP sudah dikirim ke email.');
    }

    // Form input OTP + password baru
    public function verifyOtpForm()
    {
        return view('auth.passwords.verify_otp');
    }

    // Verifikasi OTP dan ubah password
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'otp'      => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $otpRecord = DB::table('password_otps')
            ->where('username', $request->username)
            ->where('otp_code', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'OTP tidak valid atau sudah kadaluarsa.');
        }

        // update password user
        DB::table('users')->where('username', $request->username)
            ->update(['password' => bcrypt($request->password)]);

        // hapus OTP agar tidak bisa dipakai lagi
        DB::table('password_otps')->where('id', $otpRecord->id)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset.');
    }
}
