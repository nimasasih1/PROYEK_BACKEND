<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        try {
            if (empty($row['username']) || empty($row['email'])) {
                Log::warning('Skipping empty row');
                return null;
            }

            $existingUser = User::where('email', $row['email'])
                                ->orWhere('username', $row['username'])
                                ->first();
            
            if ($existingUser) {
                Log::warning('User already exists: ' . $row['username']);
                return null;
            }

            $validRoles = ['mahasiswa','baak','perpustakaan','finance','fakultas'];

            return new User([
                'username' => trim($row['username']),
                'email'    => trim($row['email']),
                'password' => Hash::make($row['password'] ?? 'password123'),
                'role'     => in_array(trim($row['role'] ?? ''), $validRoles) ? trim($row['role']) : 'user',
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to import user', [
                'username' => $row['username'] ?? 'unknown',
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|email|unique:users,email',
            'role'     => 'nullable|in:mahasiswa,baak,perpustakaan,finance,fakultas'
        ];
    }
}
