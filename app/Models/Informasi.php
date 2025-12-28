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
        'lokasi',
        'jumlah_wisudawan',
        'jadwal_wisuda',
        'informasi_baak',
    ];
}
