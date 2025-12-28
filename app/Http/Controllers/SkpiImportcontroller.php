<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Imports\SkpiImport;
use App\Models\Mahasiswa;
use App\Models\Skpi;

class SkpiImportController extends Controller
{
    public function import(Request $request)
    {
        // ==============================
        // VALIDASI FILE
        // ==============================
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
            // ==============================
            // SIMPAN FILE
            // ==============================
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = 'import_skpi_' . time() . '.' . $extension;

            $destinationPath = storage_path('app/imports');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);
            $fullPath = $destinationPath . '/' . $fileName;

            Log::info('=== STARTING SKPI IMPORT ===', [
                'file' => $fileName,
                'path' => $fullPath
            ]);

            // ==============================
            // PREVIEW FILE
            // ==============================
            $previewData = Excel::toArray([], $fullPath);

            if (empty($previewData) || empty($previewData[0])) {
                throw new \Exception('File kosong atau tidak dapat dibaca.');
            }

            $allRows = $previewData[0];
            $header = array_map(fn($h) => strtolower(trim($h)), $allRows[0] ?? []);

            // ==============================
            // VALIDASI HEADER WAJIB
            // ==============================
            $requiredFields = ['nim', 'tgl_pengajuan_mahasiswa'];
            $missing = array_diff($requiredFields, $header);

            if (!empty($missing)) {
                throw new \Exception(
                    'Header tidak lengkap. Field wajib: ' . implode(', ', $missing)
                );
            }

            // ==============================
            // VALIDASI NIM & RELASI SKPI
            // ==============================
            $nimIndex = array_search('nim', $header);
            $invalidNims = [];
            $skippedNoSkpi = [];

            for ($i = 1; $i < count($allRows); $i++) {
                $row = $allRows[$i];

                if (empty(array_filter($row))) {
                    continue;
                }

                $nim = trim($row[$nimIndex] ?? '');
                $nim = preg_replace('/[^0-9]/', '', $nim);

                if (empty($nim)) {
                    continue;
                }

                $mahasiswa = Mahasiswa::where('nim', $nim)->first();

                if (!$mahasiswa) {
                    $invalidNims[] = $nim;
                    continue;
                }

                if (!Skpi::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->exists()) {
                    $skippedNoSkpi[] = $nim;
                }
            }

            // Jika ada NIM tidak terdaftar
            if (!empty($invalidNims)) {
                return back()->with('error_swal', 
                    'Import dibatalkan. NIM tidak terdaftar: ' .
                        implode(', ', array_unique(array_slice($invalidNims, 0, 10)))
                );
            }

            // ==============================
            // PROSES IMPORT
            // ==============================
            $countBefore = Skpi::count();
            Excel::import(new SkpiImport, $fullPath);
            $countAfter = Skpi::count();
            $imported = $countAfter - $countBefore;

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            // ==============================
            // RESPONSE NOTIFIKASI
            // ==============================
            $message = "Import SKPI berhasil. {$imported} data diperbarui.";

            if (!empty($skippedNoSkpi)) {
                $message .= " | Dilewati (belum isi SKPI): " .
                    implode(', ', array_unique(array_slice($skippedNoSkpi, 0, 5)));

                if (count($skippedNoSkpi) > 5) {
                    $message .= ' ...';
                }
            }

            return back()->with('success_swal', $message);

        } catch (\Exception $e) {
            Log::error('=== SKPI IMPORT ERROR ===', [
                'message' => $e->getMessage()
            ]);

            if ($fullPath && file_exists($fullPath)) {
                unlink($fullPath);
            }

            return back()->with('error_swal', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function download()
    {
        $filePath = public_path('templates/users.xlsx');

        if (!file_exists($filePath)) {
            return back()->with('error_swal', 'File template tidak ditemukan.');
        }

        return response()->download($filePath, 'skpi_template.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
