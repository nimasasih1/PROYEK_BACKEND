<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tahun_lulus');
            $table->text('testimoni');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimoni');
    }
};