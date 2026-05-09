<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('syarat_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number')->default(0);
            $table->string('title_en');
            $table->string('title_id');
            $table->text('description_en');
            $table->text('description_id');
            $table->string('icon')->default('bi-check2-square');
            $table->string('color')->default('#6c757d');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_items');
    }
};
