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
        Schema::create('mt_orang_tua', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('acara_id')->constrained('mt_acara')->onDelete('cascade');
            $table->enum('jenis_orang_tua', ['MEMPELAI_PRIA', 'MEMPELAI_WANITA']);
            $table->enum('jenis', ['AYAH', 'IBU']);
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat')->nullable();
            $table->boolean('masih_hidup')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_orang_tua');
    }
};
