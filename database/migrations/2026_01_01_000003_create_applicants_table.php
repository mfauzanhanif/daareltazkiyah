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
        Schema::create('applicants', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('admission_wave_id')->constrained('admission_waves')->restrictOnDelete();
            $table->string('registration_number')->unique();
            $table->string('access_token', 8)->unique();
            $table->string('program_type')->index();
            $table->string('full_name');
            $table->string('nik', 16)->index();
            $table->string('nisn', 10)->nullable();
            $table->string('gender', 1);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->unsignedTinyInteger('child_order');
            $table->unsignedTinyInteger('total_siblings')->nullable();
            $table->string('previous_school');
            $table->string('school_level')->nullable();
            $table->text('school_address')->nullable();
            $table->text('address');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('village')->nullable();
            $table->unsignedBigInteger('registration_fee');
            $table->string('payment_status')->default('unpaid')->index();
            $table->string('application_status')->default('pending')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['nik', 'admission_wave_id']);
            $table->index(['program_type', 'application_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
