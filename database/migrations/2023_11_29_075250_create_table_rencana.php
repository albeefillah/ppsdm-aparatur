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
        Schema::create('rencana_anggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pokja')->references('id')->on('pokja')->nullable();
            $table->foreignId('id_role')->references('id')->on('role')->nullable();
            $table->json('rencana')->nullable();
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_anggaran');
    }
};
