<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom username (sudah ada di tabel kamu, tapi pastikan ada)
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable()->after('id');
            }
            
            // Tambah kolom role
            $table->enum('role', ['mahasiswa', 'baak', 'finance', 'perpustakaan', 'fakultas'])
                  ->default('mahasiswa')
                  ->after('email');
            
            // Tambah kolom foto untuk admin
            $table->string('foto')->nullable()->after('role');
            
            // Tambah kolom password hint (untuk fitur lupa password)
            $table->string('password_hint_last_char', 1)->nullable()->after('password');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'foto', 'password_hint_last_char']);
            // Jangan drop username karena mungkin sudah ada sebelumnya
        });
    }
};