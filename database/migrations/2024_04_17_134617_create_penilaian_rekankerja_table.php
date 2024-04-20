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
        Schema::create('penilaian_rekankerja', function (Blueprint $table) {
            $table->id();
            $table->enum('status_penilaian',['Sudah dinilai', 'Belum dinilai'])->default('Belum dinilai');
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->unsignedBigInteger('karyawan_menilai_id');
            $table->foreign('karyawan_menilai_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->unsignedBigInteger('periode_id');
            $table->foreign('periode_id')->references('id')->on('kelola_penilai')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_rekankerja');
    }
};
