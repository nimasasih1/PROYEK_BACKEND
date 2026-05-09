<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran_wisuda', function (Blueprint $table) {
            $table->string('nama_kaprodi')->nullable()->after('catatan_baak');
            $table->string('nama_dekan')->nullable()->after('nama_kaprodi');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran_wisuda', function (Blueprint $table) {
            $table->dropColumn(['nama_kaprodi', 'nama_dekan']);
        });
    }
};