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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('fase_proyek');
            $table->string('keterangan_tugas');
            $table->string('nama_tugas');
            $table->date('deadline_tugas');
            $table->string('berkas_tugas')->nullable();
            $table->string('upload_berkas')->nullable();
            $table->longText('catatan_karyawan')->nullable();
            $table->longText('catatan_revisi')->nullable();
            $table->enum('status_tugas',['Selesai', 'Revisi', 'Proses', 'Review'])->default('Proses');
            $table->unsignedBigInteger('proyek_id');
            $table->unsignedBigInteger('m_karyawan_id');
            $table->unsignedBigInteger('direktur_id');
            $table->foreign('direktur_id')->references('id')->on('direktur')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('m_karyawan_id')->references('id')->on('karyawan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proyek_id')->references('id')->on('proyek')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
