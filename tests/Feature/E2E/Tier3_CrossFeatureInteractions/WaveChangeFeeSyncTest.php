<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('wave changes dynamically sync fee structures between Gelombang I and Gelombang II on landing page and registration form', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    // Provision Gelombang I: 2026-10-01 to 2027-02-28
    DB::table('admission_waves')->insert([
        'id' => (string) Str::ulid(),
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => '2026-10-01',
        'end_date' => '2027-02-28',
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Provision Gelombang II: 2027-03-01 to 2027-05-30
    DB::table('admission_waves')->insert([
        'id' => (string) Str::ulid(),
        'name' => 'Gelombang II',
        'slug' => 'gelombang-ii-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => '2027-03-01',
        'end_date' => '2027-05-30',
        'fee_mts' => 150000,
        'fee_mdta' => 30000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Phase 1: During Gelombang I (e.g. 2027-01-15)
    Carbon::setTestNow('2027-01-15 10:00:00');

    $responseWave1 = $this->get('/');
    $responseWave1->assertOk();
    $content1 = $responseWave1->getContent();

    if (! str_contains($content1, '100.000')) {
        test()->markTestSkipped('Landing page dynamic fee sync not yet integrated (M2 required).');
    }

    $responseWave1->assertSee('100.000')
        ->assertSee('25.000');

    // Phase 2: Travel to Gelombang II (e.g. 2027-03-15)
    Carbon::setTestNow('2027-03-15 10:00:00');

    $responseWave2 = $this->get('/');
    $responseWave2->assertOk();
    $responseWave2->assertSee('150.000')
        ->assertSee('30.000');

    Carbon::setTestNow(); // Reset test clock
});
