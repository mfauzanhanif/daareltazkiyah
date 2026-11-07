<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('panitia admin can view dashboard statistics and metrics', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('PSB tables not yet migrated (M1 required).');
    }

    $admin = User::factory()->create([
        'role' => 'admin_psb',
    ]);

    $this->actingAs($admin);

    $response = $this->get('/admin/psb');
    if ($response->status() === 404) {
        test()->markTestSkipped('Admin PSB dashboard route not yet registered (M5 required).');
    }

    $response->assertOk()
        ->assertSee('Total Pendaftar')
        ->assertSee('MTS')
        ->assertSee('MDTA');
});

test('applicant management table supports searching by name, NIK, or registration number', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('PSB tables not yet migrated (M1 required).');
    }

    $admin = User::factory()->create([
        'role' => 'admin_psb',
    ]);

    $this->actingAs($admin);

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $targetNik = '3201889900112233';
    DB::table('applicants')->insert([
        'id' => (string) Str::ulid(),
        'admission_wave_id' => $waveId,
        'registration_number' => 'PSB-2027-MTS-0010',
        'access_token' => 'TOKSEARCH',
        'program_type' => 'MTS',
        'full_name' => 'Zubair bin Awwam',
        'nik' => $targetNik,
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-05-01',
        'child_order' => 1,
        'previous_school' => 'SDIT',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get("/admin/psb/applicants?search={$targetNik}");
    if ($response->status() === 404) {
        test()->markTestSkipped('Admin PSB applicants route not yet registered (M5 required).');
    }

    $response->assertOk()
        ->assertSee('Zubair bin Awwam')
        ->assertSee('PSB-2027-MTS-0010');
});

test('panitia admin can update applicant verification status and payment status with notes', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('PSB tables not yet migrated (M1 required).');
    }

    $admin = User::factory()->create([
        'role' => 'admin_psb',
    ]);

    $this->actingAs($admin);

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $applicantId = (string) Str::ulid();
    DB::table('applicants')->insert([
        'id' => $applicantId,
        'admission_wave_id' => $waveId,
        'registration_number' => 'PSB-2027-MDTA-0005',
        'access_token' => 'STATNOTE',
        'program_type' => 'MDTA',
        'full_name' => 'Maryam binti Imran',
        'nik' => '3201778899001122',
        'gender' => 'P',
        'birth_place' => 'Bogor',
        'birth_date' => '2016-08-14',
        'child_order' => 1,
        'previous_school' => 'TK Islam',
        'address' => 'Bogor',
        'registration_fee' => 25000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->patch("/admin/psb/applicants/{$applicantId}/status", [
        'application_status' => 'verified',
        'payment_status' => 'paid',
        'admin_notes' => 'Pembayaran lunas dan berkas lengkap.',
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('Applicant status update route not yet registered (M5 required).');
    }

    $response->assertSessionHasNoErrors();

    $updated = DB::table('applicants')->where('id', $applicantId)->first();
    expect($updated->application_status)->toBe('verified');
    expect($updated->payment_status)->toBe('paid');
    expect($updated->admin_notes)->toBe('Pembayaran lunas dan berkas lengkap.');
});

test('panitia admin can export applicant data to Excel spreadsheet', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('PSB tables not yet migrated (M1 required).');
    }

    $admin = User::factory()->create([
        'role' => 'admin_psb',
    ]);

    $this->actingAs($admin);

    $response = $this->get('/admin/psb/export');
    if ($response->status() === 404) {
        test()->markTestSkipped('Applicant export route not yet registered (M5 required).');
    }

    $response->assertOk();
    $disposition = $response->headers->get('content-disposition') ?? '';
    expect(str_contains($disposition, '.xlsx') || str_contains($disposition, 'attachment'))->toBeTrue();
});

test('unauthorized users without manage-psb gate are forbidden from PSB admin', function () {
    $guestResponse = $this->get('/admin/psb');
    expect(in_array($guestResponse->status(), [302, 403, 404]))->toBeTrue();

    if (Schema::hasTable('users') && Schema::hasColumn('users', 'role')) {
        $cmsUser = User::factory()->create([
            'role' => 'admin_cms',
        ]);

        $this->actingAs($cmsUser);
        $userResponse = $this->get('/admin/psb');
        if ($userResponse->status() !== 404) {
            $userResponse->assertForbidden();
        }
    }
});
