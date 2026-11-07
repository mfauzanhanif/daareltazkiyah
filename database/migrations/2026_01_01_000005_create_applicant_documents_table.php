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
        Schema::create('applicant_documents', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('applicant_id')->constrained('applicants')->cascadeOnDelete();
            $table->string('document_type')->index();
            $table->string('file_path');
            $table->string('original_name');
            $table->timestamps();

            $table->index(['applicant_id', 'document_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_documents');
    }
};
