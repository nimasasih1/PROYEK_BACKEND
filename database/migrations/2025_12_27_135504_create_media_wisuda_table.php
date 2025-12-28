<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media_wisuda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar');
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_wisuda');
    }
};