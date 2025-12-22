<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranWisuda extends Model
{
    protected $table = 'pendaftaran_wisuda';

    protected $primaryKey = 'id_pendaftaran';

    public $timestamps = true; // karena ada created_at & updated_at

    protected $fillable = [
        'id_mahasiswa',
        'tgl_pendaftaran',
        'status_pendaftaran',

        'is_valid_finance',
        'is_valid_perpus',
        'is_valid_fakultas',
        'is_valid_baak',

        'catatan_baak',
        'catatan_finance',
        'catatan_perpus',
        'catatan_facultas', // WAJIB ikut typo DB

        'judul_deskriptif',
        'tanggal_perkiraan_wisuda',
        'ipk',
        'judul_skripsi',
    ];

    /* ================= RELATION ================= */

    public function mahasiswa()
    {
        return $this->belongsTo(
            Mahasiswa::class,
            'id_mahasiswa',
            'id_mahasiswa'
        );
    }

    public function toga()
    {
        return $this->hasOne(
            Toga::class,
            'id_pendaftaran',
            'id_pendaftaran'
        );
    }
}
