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
        Schema::create('hasil_penilaian_rekankerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilaian_id');
            $table->foreign('penilaian_id')->references('id')->on('penilaian_rekankerja')->onDelete('cascade');
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->decimal('total_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_penilaian_rekankerja');
    }
};
