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
        Schema::create('rkakl_awal', function (Blueprint $table) {
            $table->id();
            // $table->json('program')->nullable();
            // $table->json('kegiatan_program')->nullable();
            // $table->json('kro')->nullable();
            // $table->json('rincian_output')->nullable();
            // $table->json('subkom')->nullable();
            // $table->json('detail')->nullable();
            // $table->json('akun')->nullable();
            // $table->string('tahun')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rkakl_awal');
    }
};
