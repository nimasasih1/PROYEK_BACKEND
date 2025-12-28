<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom username (untuk NIM mahasiswa atau username admin)
            $table->string('username')->unique()->nullable()->after('id');
            
            // Tambah kolom role (mahasiswa, baak, finance, perpustakaan, fakultas)
            $table->enum('role', ['mahasiswa', 'baak', 'finance', 'perpustakaan', 'fakultas'])
                  ->default('mahasiswa')
                  ->after('email');
            
            // Tambah kolom foto untuk admin
            $table->string('foto')->nullable()->after('role');
            
            // Tambah kolom password hint
            $table->string('password_hint_last_char', 1)->nullable()->after('password');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'role', 'foto', 'password_hint_last_char']);
        });
    }
};