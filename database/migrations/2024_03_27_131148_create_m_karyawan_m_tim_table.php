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
        Schema::create('m_karyawan_m_tim', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_karyawan_id');
            $table->foreign('m_karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->unsignedBigInteger('m_tim_id');
            $table->foreign('m_tim_id')->references('id')->on('tim')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_tim');
    }
};
