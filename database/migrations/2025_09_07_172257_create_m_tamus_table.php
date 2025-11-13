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
        Schema::create('mt_tamu', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('acara_id')->constrained('mt_acara')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('kategori_tamu', ['KELUARGA_PRIA', 'KELUARGA_WANITA', 'TEMAN_PRIA', 'TEMAN_WANITA', 'REKAN_KERJA_PRIA', 'REKAN_KERJA_WANITA', 'TETANGGA_PRIA', 'TETANGGA_WANITA', 'LAINNYA']);
            $table->boolean('konfirmasi_kehadiran')->default(false);
            $table->integer('jumlah_hadir')->nullable();
            $table->text('ucapan_konfirmasi')->nullable();
            $table->enum('status_kehadiran', ['BELUM_KONFIRMASI', 'HADIR', 'TIDAK_HADIR'])->default('BELUM_KONFIRMASI');
            $table->timestamp('waktu_konfirmasi')->nullable();
            $table->timestamp('waktu_hadir')->nullable();
            $table->string('qr_code')->nullable(); // QR Code untuk scan kehadiran
            $table->text('catatan_tambahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_tamu');
    }
};
