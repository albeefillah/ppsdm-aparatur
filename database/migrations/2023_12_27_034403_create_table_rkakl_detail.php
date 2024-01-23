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
        Schema::create('rkakl_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rkakl')->references('id')->on('rkakl_new')->onDelete('cascade');
            $table->foreignId('id_parent')->references('id')->on('rkakl_detail')->onDelete('cascade');
            $table->string('kode');
            $table->text('desc');
            $table->string('pagu');
            // tambahkan kolom lainnya sesuai kebutuhan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rkakl_detail');
    }
};
