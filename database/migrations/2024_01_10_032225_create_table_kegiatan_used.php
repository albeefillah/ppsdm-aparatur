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
        Schema::create('kegiatan_used', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rkakl')->references('id')->on('rkakl_awal')->onDelete('cascade');
            $table->foreignId('id_detkom')->references('id')->on('detail_komponen')->onDelete('cascade');
            $table->json('akun_used');
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_used');
    }
};
