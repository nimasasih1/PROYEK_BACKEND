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
        'mahasiswa_aktif',
        'calon_lulusan',
        'jadwal_wisuda',
        'informasi_baak',
        'foto_gallery',
        'foto_gallery_2',
        'foto_gallery_3',
        'foto_gallery_4',
    ];
}