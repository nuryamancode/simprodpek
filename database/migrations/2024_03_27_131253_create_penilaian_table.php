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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id');
            $table->unsignedBigInteger('subkriteria_id');
            $table->unsignedBigInteger('periode_id');
            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('cascade');
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
            $table->foreign('subkriteria_id')->references('id')->on('sub_kriteria')->onDelete('cascade');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};