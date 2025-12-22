<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    protected $table = 'skpi';
    protected $primaryKey = 'id_skpi';

    protected $fillable = [
        'id_mahasiswa',
        'tgl_pengajuan_mahasiswa',
        'tempat_lahir',
        'tahun_lulus',
        'no_ijazah',
        'gelar',
        'sk_pendirian_perti',
        'persyaratan_penerimaan',
        'nama_perti',
        'bahasa_pengantar_kuliah',
        'sistem_penilaian',
        'kelas',
        'lama_studi_rg',
        'jenjang_pd_lanjutan',
        'jenjang_kualif_kkn1',
        'status_profesi',
        'penguasaan_pengetahuan',
        'aktiv_pres_penghargaan',
        'magang',
        'jenjangpend_syaratbelajar',
        'sks_lamastudi',
        'kota',
        'tanggal_skpi',
        'kemampuan_kerja',
        'info_kkni',
        'file_pdf',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}


    // Relasi ke mahasiswa
