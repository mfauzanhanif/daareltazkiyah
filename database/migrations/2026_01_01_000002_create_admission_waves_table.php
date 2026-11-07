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
        Schema::create('admission_waves', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('academic_year')->index();
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->unsignedBigInteger('fee_mts');
            $table->unsignedBigInteger('fee_mdta');
            $table->unsignedInteger('max_quota_mts')->nullable();
            $table->unsignedInteger('max_quota_mdta')->nullable();
            $table->timestamps();

            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_waves');
    }
};
