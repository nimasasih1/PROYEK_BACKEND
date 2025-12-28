<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $table = 'statistik';
    protected $fillable = ['total_lulusan', 'mahasiswa_aktif', 'calon_lulusan'];
}