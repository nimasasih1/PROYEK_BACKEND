<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi_wisuda';
    protected $primaryKey = 'id_info';

    protected $fillable = [
        'jadwal_undangan',
        'lokasi',
        'jumlah_wisudawan',
        'informasi_baak',
        'info_lulusan',
        'jadwal_wisuda',
        'review'
    ];
}
