<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesanModel extends Model
{
    protected $table = 'kesan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nim',
        'nama',
        'kesan',
        'tanggal',
        'status',
    ];

    public $timestamps = false; // Karena tabel tidak memiliki created_at / updated_at
}
