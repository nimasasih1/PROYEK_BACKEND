<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    protected $table = 'skpi';
    protected $primaryKey = 'id_skpi';
    protected $fillable = [
        'id_mahasiswa',
        'tgl_pengajuan_mahasiswa',
        'nama_departement_biro',
        'ttd_mahasiswa',
        'ttd_admin',
        'jenjang_mahasiswa',
        'no_hp_mahasiswa',
        'email_mahasiswa',
        'alamat_mahasiswa',
        'judul',
        'tanggal_terbit',
    ];

    // relasi ke mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
