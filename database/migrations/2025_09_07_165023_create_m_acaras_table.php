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
        Schema::create('mt_acara', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('kode_acara')->unique();
            $table->string('nama_mempelai_pria');
            $table->string('nama_mempelai_wanita');
            $table->string('nama_acara')->default('Pernikahan');
            $table->date('tanggal_acara');
            $table->text('deskripsi_acara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_acara');
    }
};
