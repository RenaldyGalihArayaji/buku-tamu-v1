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
        Schema::create('mt_detail_acara', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('acara_id')->constrained('mt_acara')->onDelete('cascade');
            $table->string('nama_detail_acara');  // Nama Detail Acara. contoh: Akad Nikah, Resepsi
            $table->text('alamat_detail_acara');
            $table->string('lokasi_detail_acara');
            $table->date('tanggal_detail_acara');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->text('deskripsi_detail_acara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_detail_acara');
    }
};
