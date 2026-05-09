<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Log;
use App\Exports\MahasiswaTemplateExport;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
// PROSES IMPORT
// ==============================
$countBefore = Mahasiswa::count();

$import = new MahasiswaImport;
Excel::import($import, $fullPath);

$countAfter = Mahasiswa::count();
$actualImported = $countAfter - $countBefore;

// ==============================
// BUAT AKUN + KIRIM EMAIL
// ==============================
$dataRows = array_slice($allRows, 1); // skip header
$emailTerkirim = 0;

foreach ($dataRows as $row) {
    $rowData = array_combine($header, $row);

    $nim   = trim($rowData['nim'] ?? '');
    $email = trim($rowData['email'] ?? '');
    $nama  = trim($rowData['nama_mahasiswa'] ?? '');

    if (!$nim || !$email || !$nama) continue;

    // Cek apakah akun sudah ada
    $userExists = \App\Models\User::where('username', $nim)->exists();

    if (!$userExists) {
        // Generate password random
        $plainPassword = Str::random(8);

        // Buat akun user
        \App\Models\User::create([
            'name'     => $nama,
            'username' => $nim,
            'email'    => $email,
            'password' => Hash::make($plainPassword),
            'role'     => 'mahasiswa',
        ]);

        // Kirim email
        try {
            \Illuminate\Support\Facades\Mail::to($email)
                ->send(new \App\Mail\AkunMahasiswaMail($nama, $nim, $plainPassword));
            $emailTerkirim++;
        } catch (\Exception $e) {
            Log::error('Gagal kirim email ke ' . $email . ': ' . $e->getMessage());
        }
    }
}

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
            $message = "Import successful! {$actualImported} student data added. {$emailTerkirim} account(s) created & email sent.";

            if (!empty($errors)) {
                $message .= " Error details: " . implode(' | ', array_slice($errors, 0, 5));
                if (count($errors) > 5) {
                    $message .= " ... and " . (count($errors) - 5) . " more errors. Check log for details.";
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

            return back()->with('error', 'Import failed: ' . $e->getMessage());
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
