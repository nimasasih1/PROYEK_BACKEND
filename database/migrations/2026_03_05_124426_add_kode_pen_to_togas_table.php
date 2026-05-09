<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('pengambilan', function (Blueprint $table) {
        $table->string('kode_pen', 50)->nullable()->after('catatan');
    });
}

public function down(): void
{
    Schema::table('pengambilan', function (Blueprint $table) {
        $table->dropColumn('kode_pen');
    });
}
};