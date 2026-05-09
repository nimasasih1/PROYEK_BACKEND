<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informasi_wisuda', function (Blueprint $table) {
            $table->string('foto_gallery_2')->nullable()->after('foto_gallery');
            $table->string('foto_gallery_3')->nullable()->after('foto_gallery_2');
            $table->string('foto_gallery_4')->nullable()->after('foto_gallery_3');
        });
    }

    public function down(): void
    {
        Schema::table('informasi_wisuda', function (Blueprint $table) {
            $table->dropColumn(['foto_gallery_2', 'foto_gallery_3', 'foto_gallery_4']);
        });
    }
};