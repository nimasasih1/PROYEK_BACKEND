<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Log;
use App\Exports\UserTemplateExport;

class UserImportController extends Controller
{
    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:2048'
        ], [
            'file.required' => 'File harus dipilih',
            'file.mimes' => 'File harus berformat CSV, XLSX, atau XLS',
            'file.max' => 'Ukuran file maksimal 2MB'
        ]);

        $file = $request->file('file');

        try {
            // Ambil extension asli
            $extension = strtolower($file->getClientOriginalExtension());

            // Generate nama file unik
            $fileName = 'import_users_' . time() . '.' . $extension;

            // Simpan ke folder public/imports
            $destinationPath = public_path('imports');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);

            // Full path ke file
            $fullPath = $destinationPath . '/' . $fileName;

            Log::info('Importing file', [
                'original_name' => $file->getClientOriginalName(),
                'stored_path' => $fullPath,
                'extension' => $extension
            ]);

            // Import berdasarkan extension
            switch ($extension) {
                case 'csv':
                    Excel::import(new UsersImport, $fullPath, null, \Maatwebsite\Excel\Excel::CSV);
                    break;
                case 'xlsx':
                    Excel::import(new UsersImport, $fullPath, null, \Maatwebsite\Excel\Excel::XLSX);
                    break;
                case 'xls':
                    Excel::import(new UsersImport, $fullPath, null, \Maatwebsite\Excel\Excel::XLS);
                    break;
                default:
                    throw new \Exception('Format file tidak didukung: ' . $extension);
            }

            // Hapus file setelah import (opsional)
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            Log::info('Import completed successfully');

            return back()->with('success', 'Import berhasil! Data user telah ditambahkan.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessage = 'Terdapat error pada baris: ';
            foreach ($failures as $failure) {
                $errorMessage .= $failure->row() . ' (' . implode(', ', $failure->errors()) . '), ';
            }

            Log::error('Import validation error: ' . $errorMessage);
            return back()->with('error', $errorMessage);
        } catch (\Exception $e) {
            Log::error('Import error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Hapus file jika ada error
            if (isset($fullPath) && file_exists($fullPath)) {
                unlink($fullPath);
            }

            return back()->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function exportUsers()
    {
        return Excel::download(new UserTemplateExport, 'users.xlsx');
    }

    public function download()
    {
        $filePath = public_path('templates/users.xlsx');

        if (!file_exists($filePath)) {
            return back()->with('error', 'File template tidak ditemukan.');
        }

        // Unduh file
        return response()->download($filePath, 'user_template.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
