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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('art_gallery_id')
                ->nullable()
                ->constrained('art_galleries')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['art_gallery_id']);
            $table->dropColumn('art_gallery_id');
        });
    }
};
