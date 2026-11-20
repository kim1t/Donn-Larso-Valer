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
        Schema::create('artwork_media', function (Blueprint $table) {
            $table->id();

            $table->foreignId('artwork_id')
              ->constrained('artworks')
              ->cascadeOnDelete();

            $table->foreignId('media_id')
              ->constrained('media')
              ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artwork_media');
    }
};
