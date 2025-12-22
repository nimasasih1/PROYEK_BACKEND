<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Log;
use App\Exports\MahasiswaTemplateExport;
use App\Models\User;
use App\Models\Mahasiswa;

class MahasiswaImportController extends Controller
{
    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:2048'
        ], [
            'file.required' => 'File harus dipilih',
            'file.mimes'    => 'File harus berformat CSV, XLSX, atau XLS',
            'file.max'      => 'Ukuran file maksimal 2MB'
        ]);

        $file = $request->file('file');
        $fullPath = null;

        try {
            // Ambil extension asli
            $extension = strtolower($file->getClientOriginalExtension());

            // Generate nama file unik
            $fileName = 'import_mahasiswa_' . time() . '.' . $extension;

            // Simpan ke folder storage (lebih aman dari public)
            $destinationPath = storage_path('app/imports');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);

            // Full path ke file
            $fullPath = $destinationPath . '/' . $fileName;

            Log::info('=== STARTING MAHASISWA IMPORT ===', [
                'original_name' => $file->getClientOriginalName(),
                'stored_path'   => $fullPath,
                'extension'     => $extension,
                'file_size'     => filesize($fullPath)
            ]);

            // ==============================
            // BACA DAN PREVIEW FILE
            // ==============================
            $previewData = Excel::toArray([], $fullPath);

            if (empty($previewData) || empty($previewData[0])) {
                throw new \Exception('File kosong atau tidak dapat dibaca. Pastikan file Excel memiliki data.');
            }

            $allRows = $previewData[0];

            Log::info('File preview', [
                'total_rows' => count($allRows),
                'header' => $allRows[0] ?? [],
                'first_data_row' => $allRows[1] ?? []
            ]);

            // Ambil header
            $header = array_map(function ($h) {
                return strtolower(trim($h));
            }, $allRows[0] ?? []);

            // Cek apakah header ada field required
            $requiredFields = ['nim', 'nama_mahasiswa', 'tahun'];
            $headerString = implode('', $header); // Gabungkan semua header jadi satu string

            $missingFields = [];
            foreach ($requiredFields as $field) {
                $cleanField = str_replace('_', '', $field);
                if (strpos($headerString, $cleanField) === false && !in_array($field, $header)) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                throw new \Exception('Header tidak lengkap. Field yang hilang: ' . implode(', ', $missingFields) . '. Header yang terdeteksi: ' . implode(', ', $header));
            }

            // ==============================
            // VALIDASI NIM KE TABEL USERS
            // ==============================
            $invalidNims = [];
            $validRows = [];

            // Tentukan index kolom nim
            $nimIndex = array_search('nim', $header);
            $namaIndex = array_search('nama_mahasiswa', $header);

            // Jika tidak ketemu, coba cari tanpa underscore
            if ($nimIndex === false) {
                $headerNoUnderscore = array_map(function ($h) {
                    return str_replace(['_', ' '], '', $h);
                }, $header);
                $nimIndex = array_search('nim', $headerNoUnderscore);
            }

            if ($namaIndex === false) {
                $headerNoUnderscore = array_map(function ($h) {
                    return str_replace(['_', ' '], '', $h);
                }, $header);
                $namaIndex = array_search('namamahasiswa', $headerNoUnderscore);
            }

            Log::info('Column indices', [
                'nim_index' => $nimIndex,
                'nama_index' => $namaIndex,
                'header' => $header
            ]);

            // Loop dari row ke-2 (index 1, karena 0 adalah header)
            for ($i = 1; $i < count($allRows); $i++) {
                $row = $allRows[$i];

                // Skip empty rows
                if (empty(array_filter($row))) {
                    continue;
                }

                $nim = $nimIndex !== false ? ($row[$nimIndex] ?? null) : null;
                $nama = $namaIndex !== false ? ($row[$namaIndex] ?? null) : null;

                if (empty($nim) || empty($nama)) {
                    Log::warning("Row " . ($i + 1) . " skipped - empty NIM or name", [
                        'nim' => $nim,
                        'nama' => $nama
                    ]);
                    continue;
                }

                // Bersihkan NIM
                $nim = trim($nim);
                $nim = trim($nim, "\"'");
                $cleanNim = preg_replace('/[^0-9]/', '', $nim);

                if (empty($cleanNim)) {
                    continue;
                }

                // Cek apakah NIM ada di users
                if (!User::where('username', $cleanNim)->exists()) {
                    $invalidNims[] = $cleanNim;
                }

                $validRows[] = [
                    'row' => $i + 1,
                    'nim' => $cleanNim,
                    'nama' => $nama
                ];
            }

            Log::info('Validation check', [
                'total_valid_rows' => count($validRows),
                'invalid_nims' => $invalidNims
            ]);

            // Jika ada NIM yang tidak valid
            if (!empty($invalidNims)) {
                $uniqueInvalidNims = array_unique($invalidNims);
                $msg = 'Import dibatalkan: ' . count($uniqueInvalidNims) . ' NIM tidak terdaftar sebagai user: ' . implode(', ', array_slice($uniqueInvalidNims, 0, 10));

                if (count($uniqueInvalidNims) > 10) {
                    $msg .= ' ... dan ' . (count($uniqueInvalidNims) - 10) . ' lainnya';
                }

                Log::warning($msg);

                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }

                return back()->with('error', $msg);
            }

            // ==============================
            // PROSES IMPORT
            // ==============================
            $countBefore = Mahasiswa::count();

            $import = new MahasiswaImport;
            Excel::import($import, $fullPath);

            $countAfter = Mahasiswa::count();
            $actualImported = $countAfter - $countBefore;

            // Hapus file temporary
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            // Get stats from import
            $importedCount = $import->getImportedCount();
            $errors = $import->getErrors();

            Log::info('=== IMPORT COMPLETED ===', [
                'before_count' => $countBefore,
                'after_count' => $countAfter,
                'actual_imported' => $actualImported,
                'reported_imported' => $importedCount,
                'errors_count' => count($errors)
            ]);

            // Prepare message
            $message = "Import berhasil! {$actualImported} data mahasiswa ditambahkan.";

            if (!empty($errors)) {
                $message .= " Detail error: " . implode(' | ', array_slice($errors, 0, 5));
                if (count($errors) > 5) {
                    $message .= " ... dan " . (count($errors) - 5) . " error lainnya. Cek log untuk detail.";
                }
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('=== IMPORT ERROR ===', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            if (isset($fullPath) && file_exists($fullPath)) {
                unlink($fullPath);
            }

            return back()->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function exportMahasiswa()
    {
        return Excel::download(new MahasiswaTemplateExport, 'template_mahasiswa.xlsx');
    }

    public function download()
    {
        $filePath = public_path('templates/mahasiswa.xlsx');

        if (!file_exists($filePath)) {
            return back()->with('error', 'File template tidak ditemukan.');
        }

        // Unduh file
        return response()->download($filePath, 'mahasiswa_template.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
