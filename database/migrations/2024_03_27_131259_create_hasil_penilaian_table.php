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
        Schema::create('hasil_penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periode_id');
            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('cascade');
            $table->decimal('total_nilai_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_penilaian');
    }
};
