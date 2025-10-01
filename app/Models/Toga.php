<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toga extends Model
{
    protected $table = 'pengambilan';
    protected $primaryKey = 'id_pengambilan';
    public $timestamps = true;

    protected $fillable = [
        'id_pendaftaran',
        'ukuran',
        'catatan',
        'ttd',
    ];

    /**
     * Relasi ke tabel pendaftaran_wisuda
     */
    public function pendaftaran()
    {
        return $this->belongsTo(
            PendaftaranWisuda::class, // model tujuan relasi
            'id_pengambilan',        // foreign key di tabel pengambilan
            'id_pendaftaran'         // primary key di tabel pendaftaran_wisuda
        );
    }
}
