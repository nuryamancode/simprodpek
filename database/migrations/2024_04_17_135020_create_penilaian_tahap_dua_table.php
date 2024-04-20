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
        Schema::create('penilaian_tahap_dua', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->unsignedBigInteger('penilaianrekan_id')->nullable();
            $table->foreign('penilaianrekan_id')->references('id')->on('penilaian_rekankerja')->onDelete('cascade');
            $table->unsignedBigInteger('penilaiankaryawan_id')->nullable();
            $table->foreign('penilaiankaryawan_id')->references('id')->on('penilaian_karyawan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_tahap_dua');
    }
};
