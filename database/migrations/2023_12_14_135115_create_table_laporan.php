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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pokja')->references('id')->on('pokja')->nullable();
            $table->foreignId('id_rencana')->references('id')->on('rencana_anggaran')->nullable();
            $table->foreignId('id_matang')->references('id')->on('mata_anggaran')->nullable();
            $table->foreignId('id_sisa')->references('id')->on('sisa_anggaran')->nullable();
            $table->json('program')->nullable();
            $table->json('kegiatan_program')->nullable();
            $table->json('kro')->nullable();
            $table->json('rincian_output')->nullable();
            $table->json('subkom')->nullable();
            $table->json('detail')->nullable();
            $table->json('akun')->nullable();
            $table->date('tgl_realisasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
