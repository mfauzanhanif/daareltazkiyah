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
        Schema::table('applicants', function (Blueprint $table) {
            $table->unsignedTinyInteger('total_siblings')->nullable()->after('child_order');
            $table->string('province')->nullable()->after('address');
            $table->string('city')->nullable()->after('province');
            $table->string('district')->nullable()->after('city');
            $table->string('village')->nullable()->after('district');
            $table->string('school_level')->nullable()->after('previous_school');
            $table->text('school_address')->nullable()->after('school_level');
        });

        Schema::table('applicant_parents', function (Blueprint $table) {
            $table->string('father_status')->nullable()->after('father_name');
            $table->string('father_nik', 16)->nullable()->after('father_status');
            $table->string('father_birth')->nullable()->after('father_nik');
            $table->string('father_education')->nullable()->after('father_birth');
            $table->boolean('father_pesantren')->default(false)->after('father_education');
            $table->boolean('father_no_wa')->default(false)->after('father_pesantren');

            $table->string('mother_status')->nullable()->after('mother_name');
            $table->string('mother_nik', 16)->nullable()->after('mother_status');
            $table->string('mother_birth')->nullable()->after('mother_nik');
            $table->string('mother_education')->nullable()->after('mother_birth');
            $table->boolean('mother_pesantren')->default(false)->after('mother_education');
            $table->boolean('mother_no_wa')->default(false)->after('mother_pesantren');
            $table->string('mother_phone', 20)->nullable()->after('mother_no_wa');

            $table->string('guardian_type')->nullable()->default('ayah')->after('parent_address');
            $table->string('guardian_name')->nullable()->after('guardian_type');
            $table->string('guardian_relation')->nullable()->after('guardian_name');
            $table->string('guardian_nik', 16)->nullable()->after('guardian_relation');
            $table->string('guardian_phone', 20)->nullable()->after('guardian_nik');
            $table->string('guardian_job')->nullable()->after('guardian_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn([
                'total_siblings',
                'province',
                'city',
                'district',
                'village',
                'school_level',
                'school_address',
            ]);
        });

        Schema::table('applicant_parents', function (Blueprint $table) {
            $table->dropColumn([
                'father_status',
                'father_nik',
                'father_birth',
                'father_education',
                'father_pesantren',
                'father_no_wa',
                'mother_status',
                'mother_nik',
                'mother_birth',
                'mother_education',
                'mother_pesantren',
                'mother_no_wa',
                'mother_phone',
                'guardian_type',
                'guardian_name',
                'guardian_relation',
                'guardian_nik',
                'guardian_phone',
                'guardian_job',
            ]);
        });
    }
};
