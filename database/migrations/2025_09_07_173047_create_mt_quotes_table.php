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
        Schema::create('mt_quotes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('acara_id')->constrained('mt_acara')->onDelete('cascade');
            $table->text('quote_text');
            $table->string('quote_author')->nullable();
            $table->enum('jenis_quote', ['AYAT_ALQURAN', 'HADIST', 'KATA_MUTIARA', 'DOA', 'PANTUN', 'PUISI', 'LAINNYA']);
            $table->string('sumber_quote')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('urutan')->default(0);
            $table->string('background_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_quotes');
    }
};
