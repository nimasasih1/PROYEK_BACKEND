<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Qna;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function baca()
    {
        $mahasiswa   = null;
        $pendaftaran = null;
        $lastSeen    = request()->cookie('notif_last_seen')
            ? Carbon::parse(request()->cookie('notif_last_seen'))
            : now()->subDays(7);

        // Ambil semua pengumuman/informasi, terbaru di atas
        $informasi = Informasi::latest()->get();

        // Ambil semua Q&A urut dari yang pertama
        $qna = Qna::orderBy('id_qna', 'asc')->get();

        // Ambil data catatan dari staf (jika mahasiswa sudah daftar wisuda)
        if (Auth::check()) {
            $user      = Auth::user();
            $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

            if ($mahasiswa) {
                $pendaftaran = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                    ->latest()
                    ->first();
            }
        }

        // Hitung total catatan yang sudah diisi oleh staf
        $totalCatatan = 0;
        if ($pendaftaran) {
            $totalCatatan = collect([
                $pendaftaran->catatan_fakultas,
                $pendaftaran->catatan_baak,
                $pendaftaran->catatan_perpus,
                $pendaftaran->catatan_finance,
                $pendaftaran->catatan_csdl,
            ])->filter()->count();
        }

        // Update cookie notif_last_seen
        $now = now()->toDateTimeString();

        return response()
            ->view('notifikasi', compact(
                'informasi',
                'pendaftaran',
                'totalCatatan',
                'lastSeen',
                'qna'
            ))
            ->cookie(cookie()->forever('notif_last_seen', $now));
    }
}