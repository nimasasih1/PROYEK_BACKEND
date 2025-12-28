<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'prodi',
        'foto_profil',
        'tahun',
        'fakultas',
        'jenjang',
        'no_telp',
        'email',
        'alamat',
        'tempat_lahir',   // ← sesuai tabel
        'tanggal_lahir',  // ← sesuai tabel
    ];

    public function pendaftaran()
    {
        return $this->hasOne(PendaftaranWisuda::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
