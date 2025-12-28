<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KesanModel extends Model
{
    protected $table = 'kesan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'kesan',
        'tanggal',
    ];

    public $timestamps = false; // Karena tabel tidak memiliki created_at / updated_at
}
