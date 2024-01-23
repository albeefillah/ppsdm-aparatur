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
        Schema::create('detail_komponen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sub_komponen')->references('id')->on('sub_komponen');
            $table->string('kode', 20);
            $table->string('deskripsi');
            $table->string('pagu_awal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_komponen');
    }
};
