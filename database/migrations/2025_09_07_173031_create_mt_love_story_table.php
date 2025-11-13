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
        Schema::create('mt_love_story', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('acara_id')->constrained('mt_acara')->onDelete('cascade');
            $table->string('judul');
            $table->date('tanggal_kejadian');
            $table->text('cerita');
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->enum('milestone', ['PERTAMA_BERTEMU', 'PENDEKATAN', 'PACARAN', 'LAMARAN', 'PERTUNANGAN', 'LAINNYA']);
            $table->string('lokasi_kejadian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_love_story');
    }
};
