<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MediaWisuda extends Model
{
    protected $table = 'media_wisuda';
    protected $fillable = ['judul', 'gambar', 'deskripsi', 'urutan'];
}