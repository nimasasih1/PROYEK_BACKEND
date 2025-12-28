<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->id();
            $table->integer('total_lulusan')->default(0);
            $table->integer('mahasiswa_aktif')->default(0);
            $table->integer('calon_lulusan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('statistik');
    }
};