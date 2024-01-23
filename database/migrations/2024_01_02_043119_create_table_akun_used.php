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
        Schema::create('akun_used', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_role')->references('id')->on('role')->onDelete('cascade');
            $table->foreignId('id_rencana')->references('id')->on('rencana_anggaran')->onDelete('cascade');
            $table->foreignId('id_rkakl')->references('id')->on('rkakl_new')->onDelete('cascade');
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun-used');
    }
};
