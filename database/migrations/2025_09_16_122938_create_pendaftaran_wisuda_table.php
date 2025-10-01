<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran_wisuda', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->date('tgl_pendaftaran');
            $table->enum('status_pendaftaran', ['pending','disetujui','ditolak'])->default('pending');
            $table->timestamps();

            $table->foreign('id_mahasiswa')
                  ->references('id_mahasiswa')
                  ->on('mahasiswa')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_wisuda');
    }
};
