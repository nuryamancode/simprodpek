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
        Schema::create('total_akhir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->unsignedBigInteger('hasildirektur_id')->nullable();
            $table->foreign('hasildirektur_id')->references('id')->on('hasil_penilaian_direktur');
            $table->unsignedBigInteger('hasilrekankerja_id')->nullable();
            $table->foreign('hasilrekankerja_id')->references('id')->on('hasil_penilaian_rekankerja_total');
            $table->unsignedBigInteger('periode_id');
            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('cascade');
            $table->decimal('total_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_akhir');
    }
};
