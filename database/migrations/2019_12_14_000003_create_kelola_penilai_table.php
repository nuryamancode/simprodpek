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
        Schema::create('kelola_penilai', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->enum('jenis_dinilai', ['Direktur To Karyawan','Karyawan To Rekan Kerja']);
            $table->enum('status_penilaian', ['Sudah Dinilai','Belum Dinilai'])->default('Belum Dinilai');
            $table->unsignedBigInteger('jenis_penilai_id');
            $table->foreign('jenis_penilai_id')->references('id')->on('jenis_penilaian')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_penilai');
    }
};
