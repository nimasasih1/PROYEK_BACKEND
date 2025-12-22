<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserTemplateExport implements FromQuery, WithHeadings, WithMapping
{
    /**
     * Ambil data dari database
     */
    public function query()
    {
        return User::query()->select('username', 'email');
    }

    /**
     * Header kolom di Excel
     */
    public function headings(): array
    {
        return [
            'username',
            'email',
        ];
    }

    /**
     * Mapping data per baris
     */
    public function map($user): array
    {
        return [
            $user->username,
            $user->email,
        ];
    }
}
