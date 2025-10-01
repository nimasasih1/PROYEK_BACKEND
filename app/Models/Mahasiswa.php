<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';       // Nama tabel sesuai DB
    protected $primaryKey = 'id_mahasiswa'; // Primary key sesuai DB

    public $incrementing = true;          // jika auto increment
    protected $keyType = 'int';
    public $timestamps = false;           // tipe primary key

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'fakultas',
        'prodi',
        'tahun',
    ];

    public function pendaftaran()
    {
        return $this->hasOne(PendaftaranWisuda::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
