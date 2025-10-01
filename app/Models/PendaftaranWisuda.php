<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranWisuda extends Model
{
    protected $table = 'pendaftaran_wisuda';
    protected $primaryKey = 'id_pendaftaran';
    public $timestamps = false;

    protected $fillable = [
        'id_mahasiswa',
        'tgl_pendaftaran'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function toga()
    {
        return $this->hasOne(Toga::class, 'id_pendaftaran', 'id_pendaftaran');
    }
}
