<?php

namespace App\Imports;

use App\Models\Skpi;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SkpiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $row['nim'])->first();

        // Jika NIM tidak ditemukan → skip baris
        if (!$mahasiswa) {
            return null;
        }

        return new Skpi([
            'id_mahasiswa'              => $mahasiswa->id_mahasiswa,
            'tgl_pengajuan_mahasiswa'   => $row['tgl_pengajuan_mahasiswa'],

            'tahun_lulus'               => $row['tahun_lulus'] ?? null,
            'no_ijazah'                 => $row['no_ijazah'] ?? null,
            'gelar'                     => $row['gelar'] ?? null,

            'sk_pendirian_perti'        => $row['sk_pendirian_perti'] ?? null,
            'persyaratan_penerimaan'    => $row['persyaratan_penerimaan'] ?? null,
            'bahasa_pengantar_kuliah'   => $row['bahasa_pengantar_kuliah'] ?? null,
            'sistem_penilaian'          => $row['sistem_penilaian'] ?? null,

            'kelas'                     => $row['kelas'] ?? null,
            'lama_studi_rg'             => $row['lama_studi_rg'] ?? null,
            'jenjang_pd_lanjutan'       => $row['jenjang_pd_lanjutan'] ?? null,
            'jenjang_kualif_kkn1'       => $row['jenjang_kualif_kkn1'] ?? null,
            'status_profesi'            => $row['status_profesi'] ?? null,

            'kemampuan_kerja'           => $row['kemampuan_kerja'] ?? null,
            'penguasaan_pengetahuan'    => $row['penguasaan_pengetahuan'] ?? null,
            'jenjangpend_syaratbelajar' => $row['jenjangpend_syaratbelajar'] ?? null,

            'sks_lamastudi'             => $row['sks_lamastudi'] ?? null,
            'info_kkni'                 => $row['info_kkni'] ?? null,

            'kota'                      => $row['kota'] ?? null,
            'tanggal_skpi'              => $row['tanggal_skpi'] ?? null,
            'nama_dekan'                => $row['nama_dekan'] ?? null,
        ]);
    }
}
