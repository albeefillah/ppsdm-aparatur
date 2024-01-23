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
        Schema::create('mata_anggaran', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_belanja');
            $table->integer('akun');
            $table->string('pagu_awal')->nullable();
            $table->string('tahun_anggaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_anggaran');
    }
};
