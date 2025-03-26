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
        Schema::create('outsourcing', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('role', 100);
            $table->string('lokasi', 100);
            $table->date('tgl_piket');
            $table->string('shift');
            $table->string('kd_ket')->nullable();
            $table->text('keterangan')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outsourcing');
    }
};
