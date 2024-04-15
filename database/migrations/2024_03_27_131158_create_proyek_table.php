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
        Schema::create('proyek', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->datetime('tanggal_mulai');
            $table->datetime('tanggal_selesai');
            $table->enum('status_proyek',['Selesai', 'Proses'])->default('Proses');
            $table->unsignedBigInteger('klien_id');
            $table->foreign('klien_id')->references('id')->on('klien')->onDelete('cascade');
            $table->unsignedBigInteger('tim_id');
            $table->foreign('tim_id')->references('id')->on('tim')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek');
    }
};
