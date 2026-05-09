<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratKetentuan extends Model
{
    use HasFactory;

    protected $table = 'syarat_ketentuan';

    protected $fillable = [
        'deskripsi_1',
        'deskripsi_2',
        'deskripsi_3',
        'foto_1',
        'foto_2',
        'foto_3',
    ];
}
