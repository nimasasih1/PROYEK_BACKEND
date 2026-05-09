<?php

namespace App\Exports;

use App\Models\Mahasiswa; // ← ganti ke Mahasiswa
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserTemplateExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        // ← ganti User ke Mahasiswa
        return Mahasiswa::query()->select(
            'id_mahasiswa', 'nama_mahasiswa', 'nim', 'prodi',
            'foto_profil', 'tahun', 'fakultas', 'jenjang',
            'no_telp', 'email', 'alamat', 'tempat_lahir', 'tanggal_lahir'
        );
    }

    public function headings(): array
    {
        return [
            'ID Mahasiswa',
            'Nama Mahasiswa',
            'NIM',
            'Program Studi',
            'Foto Profil',
            'Tahun',
            'Fakultas',
            'Jenjang',
            'No. Telepon',
            'Email',
            'Alamat',
            'Tempat Lahir',
            'Tanggal Lahir',
        ];
    }

    public function map($mahasiswa): array
{
    return [
        $mahasiswa->id_mahasiswa,
        $mahasiswa->nama_mahasiswa,
        "'".$mahasiswa->nim, // 🔥 FIX DI SINI
        $mahasiswa->prodi,
        $mahasiswa->foto_profil ?? '-',
        $mahasiswa->tahun,
        $mahasiswa->fakultas,
        $mahasiswa->jenjang,
        $mahasiswa->no_telp,
        $mahasiswa->email,
        $mahasiswa->alamat,
        $mahasiswa->tempat_lahir,
        $mahasiswa->tanggal_lahir,
    ];
}
}