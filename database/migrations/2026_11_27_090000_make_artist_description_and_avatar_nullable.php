<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artists', function (Blueprint $table): void {
            $table->string('description')->nullable()->change();
            $table->string('avatar')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('artists', function (Blueprint $table): void {
            $table->string('description')->nullable(false)->change();
            $table->string('avatar')->nullable(false)->change();
        });
    }
};
