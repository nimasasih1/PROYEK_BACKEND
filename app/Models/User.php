<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',  // kode unik atau NIM
        'password',
        'role',
        'email', 
        'password_hint_last_char',     // mahasiswa, admin, baak, dll
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // login menggunakan username
    public function username()
    {
        return 'username';
    }

    // relasi ke mahasiswa (jika role mahasiswa)
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id', 'id');// --- IGNORE ---
    }
}
