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
        Schema::create('hasil_penilaian_direktur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahap_satu_id');
            $table->foreign('tahap_satu_id')->references('id')->on('penilaian_tahap_satu')->onDelete('cascade');
            $table->decimal('total_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_penilaian_direktur');
    }
};
