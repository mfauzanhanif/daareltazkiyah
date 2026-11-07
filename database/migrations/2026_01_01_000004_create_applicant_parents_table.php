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
        Schema::create('applicant_parents', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('applicant_id')->unique()->constrained('applicants')->cascadeOnDelete();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('father_job')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('parent_income')->nullable();
            $table->string('parent_phone', 20);
            $table->text('parent_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_parents');
    }
};
