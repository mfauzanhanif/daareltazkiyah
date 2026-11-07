<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('registration page displays closed status when outside all admission wave dates', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    // Only past wave exists
    DB::table('admission_waves')->insert([
        'id' => (string) Str::ulid(),
        'name' => 'Gelombang Lampau',
        'slug' => 'gelombang-lampau',
        'academic_year' => '2026/2027',
        'start_date' => now()->subMonths(3)->toDateString(),
        'end_date' => now()->subMonth()->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/psb');
    if ($response->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    $response->assertOk();
    $content = strtolower($response->getContent());
    expect(str_contains($content, 'tutup') || str_contains($content, 'belum dibuka') || str_contains($content, 'closed'))->toBeTrue();
});

test('rejects direct registration submission when no admission wave is active', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    // Empty admission_waves table or only expired wave
    $response = $this->post('/psb/daftar', [
        'program_type' => 'MTS',
        'full_name' => 'Calon Santri Terlambat',
        'nik' => '3201990011223344',
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    // Must not allow successful registration without an active wave
    expect(in_array($response->status(), [302, 403, 422]))->toBeTrue();
});
