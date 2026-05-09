<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    private int $importedCount = 0;
    private int $failedCount = 0;
    private array $errors = [];

    public function model(array $row)
    {
        Log::info('Processing row', [
            'row' => $row
        ]);

        // ===== VALIDASI MANUAL =====
        if (
            empty($row['nim']) ||
            empty($row['nama_mahasiswa']) ||
            empty($row['tahun'])
        ) {
            $this->failedCount++;
            $this->errors[] = 'Data tidak lengkap: ' . json_encode($row);
            return null;
        }

        $tanggalLahir = null;

        if (!empty($row['tanggal_lahir'])) {
            if (is_numeric($row['tanggal_lahir'])) {
                // Excel date (37844)
                $tanggalLahir = Carbon::instance(
                    ExcelDate::excelToDateTimeObject($row['tanggal_lahir'])
                )->format('Y-m-d');
            } else {
                // String date
                $tanggalLahir = Carbon::parse($row['tanggal_lahir'])->format('Y-m-d');
            }
        }

        // Bersihkan NIM
        $nim = preg_replace('/[^0-9]/', '', trim($row['nim']));

        // Cegah duplikasi
        if (Mahasiswa::where('nim', $nim)->exists()) {
            $this->failedCount++;
            $this->errors[] = "NIM sudah ada: {$nim}";
            return null;
        }

        try {
            $this->importedCount++;

            return new Mahasiswa([
                'nim'            => $nim,
                'nama_mahasiswa' => trim($row['nama_mahasiswa']),
                'prodi'          => $row['prodi'] ?? null,
                'tahun'          => (int) $row['tahun'],
                'fakultas'       => $row['fakultas'] ?? null,
                'jenjang'        => $row['jenjang'] ?? null,
                'no_telp'        => $row['no_telp'] ?? null,
                'email'          => $row['email'] ?? null,
                'alamat'         => $row['alamat'] ?? null,
                'tempat_lahir'   => $row['tempat_lahir'] ?? null,
                'tanggal_lahir'  => $tanggalLahir,
            ]);
        } catch (\Exception $e) {
            $this->importedCount--;
            $this->failedCount++;
            $this->errors[] = "Error NIM {$nim}: {$e->getMessage()}";

            Log::error('Import error', [
                'nim' => $nim,
                'error' => $e->getMessage()
            ]);

            return null;
        }
    }

    // ===== GETTER =====
    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getFailedCount(): int
    {
        return $this->failedCount;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
