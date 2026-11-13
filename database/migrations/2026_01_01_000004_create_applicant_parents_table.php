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
            $table->string('father_status')->nullable();
            $table->string('father_nik', 16)->nullable();
            $table->string('father_birth')->nullable();
            $table->string('father_education')->nullable();
            $table->boolean('father_pesantren')->default(false);
            $table->string('father_job')->nullable();
            $table->boolean('father_no_wa')->default(false);

            $table->string('mother_name');
            $table->string('mother_status')->nullable();
            $table->string('mother_nik', 16)->nullable();
            $table->string('mother_birth')->nullable();
            $table->string('mother_education')->nullable();
            $table->boolean('mother_pesantren')->default(false);
            $table->string('mother_job')->nullable();
            $table->boolean('mother_no_wa')->default(false);
            $table->string('mother_phone', 20)->nullable();

            $table->string('parent_income')->nullable();
            $table->string('parent_phone', 20);
            $table->text('parent_address');

            $table->string('guardian_type')->nullable()->default('ayah');
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_nik', 16)->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->string('guardian_job')->nullable();
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
