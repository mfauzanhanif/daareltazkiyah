<?php

declare(strict_types=1);

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
        Schema::create('gallery_photos', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('gallery_id')->constrained('galleries')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_photos');
    }
};
