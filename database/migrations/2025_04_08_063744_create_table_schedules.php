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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->nullable()->constrained()->onDelete('set null');
            $table->date('work_date');
            // $table->enum('day_type', ['pagi', 'malam', 'libur']);
            $table->unsignedTinyInteger('week_number'); // digunakan untuk rotasi job
            $table->enum('job_role', ['primary', 'secondary', 'special', 'libur']); // mempermudah filtering
            $table->timestamps();

            $table->unique(['employee_id', 'work_date']); // 1 pegawai hanya punya 1 tugas per hari
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
