<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureOtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        // cek apakah session otp_verified ada dan bernilai true
        if (!session()->has('otp_verified') || session('otp_verified') !== true) {
            return redirect()->route('password.otp.form')
                ->withErrors(['otp' => 'Anda harus memverifikasi OTP terlebih dahulu.']);
        }

        return $next($request);
    }
}
