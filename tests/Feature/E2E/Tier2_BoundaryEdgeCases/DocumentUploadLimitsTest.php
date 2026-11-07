<?php

declare(strict_types=1);

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

test('rejects document upload exceeding 2MB file size limit', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    Storage::fake('private');

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Create a 2.5MB file (2560 KB > 2048 KB limit)
    $oversizedFile = UploadedFile::fake()->create('dokumen_besar.pdf', 2560, 'application/pdf');

    $response = $this->post('/psb/daftar', [
        'admission_wave_id' => $waveId,
        'program_type' => 'MTS',
        'full_name' => 'Santri Upload Besar',
        'nik' => '3201444455556666',
        'parent_phone' => '081234567890',
        'document_kk' => $oversizedFile,
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    $response->assertSessionHasErrors('document_kk');
});

test('rejects document upload with disallowed MIME type or script extensions', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    Storage::fake('private');

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Executable/PHP file masquerading as document
    $maliciousFile = UploadedFile::fake()->create('exploit.php', 100, 'application/x-php');

    $response = $this->post('/psb/daftar', [
        'admission_wave_id' => $waveId,
        'program_type' => 'MTS',
        'full_name' => 'Security Tester',
        'nik' => '3201999988887777',
        'parent_phone' => '081234567890',
        'document_kk' => $maliciousFile,
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    $response->assertSessionHasErrors('document_kk');
});
