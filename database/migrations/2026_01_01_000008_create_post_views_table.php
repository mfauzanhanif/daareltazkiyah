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
        Schema::create('post_views', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('post_id')->constrained('posts')->cascadeOnDelete();
            $table->date('viewed_at');
            $table->unsignedInteger('count')->default(1);

            $table->unique(['post_id', 'viewed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
