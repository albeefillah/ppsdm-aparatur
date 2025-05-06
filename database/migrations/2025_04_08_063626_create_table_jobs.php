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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // contoh: R1, K1, OBM, FOP
            $table->string('name');
            $table->enum('category', ['cs', 'marbot', 'garden', 'banquet', 'women', 'koor'])->nullable();
            $table->enum('type', ['primary', 'secondary', 'special'])->nullable(); // jenis pekerjaan
            $table->string('shift', 150);
            $table->text('jobdesc')->nullable();
            $table->time('start');
            $table->time('end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
