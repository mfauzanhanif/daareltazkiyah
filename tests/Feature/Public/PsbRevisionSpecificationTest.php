<?php

declare(strict_types=1);

use App\Livewire\Public\PsbCheckStatus;
use App\Livewire\Public\PsbRegistration;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use App\Models\ApplicantParent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('navbar and footer include perlengkapan santri route', function () {
    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    expect($content)->toContain(route('psb.perlengkapan'))
        ->and($content)->toContain('Perlengkapan Santri');
});

test('psb index page renders 5 sections specified in brief revision', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 50,
        'max_quota_mdta' => 50,
    ]);

    $response = $this->get(route('psb.index'));
    $response->assertOk();

    // Section 1: Hero / CTA
    $response->assertSeeText('Penerimaan Santri Baru')
        ->assertSee(route('psb.form'), false)
        ->assertSee(route('psb.fee'), false)
        ->assertSee(route('psb.perlengkapan'), false);

    // Section 2: Alur Pendaftaran (Online & Offline)
    $response->assertSeeText('ALUR PENDAFTARAN SANTRI')
        ->assertSeeText('Pendaftaran Online')
        ->assertSeeText('Pendaftaran Offline')
        ->assertSeeText('Datang Langsung ke Sekretariat');

    // Section 3: Ringkasan Biaya & Fasilitas
    $response->assertSeeText('RINGKASAN BIAYA PENDIDIKAN')
        ->assertSeeText('Madrasah Tsanawiyah')
        ->assertSeeText('Madrasah Diniyah')
        ->assertSeeText('3.250.000')
        ->assertSeeText('3.350.000')
        ->assertSeeText('52.000');

    // Section 4: Persyaratan Berkas
    $response->assertSeeText('PERSYARATAN DOKUMEN')
        ->assertSeeText('Kartu Keluarga')
        ->assertSeeText('Akta Kelahiran');

    // Section 5: FAQ & Penutup
    $response->assertSeeText('PERTANYAAN SEPUTAR PSB (FAQ)')
        ->assertSeeText('Siap Mendaftarkan Putra-Putri Anda?');
});

test('psb fee page renders 4 sections and excludes equipment section', function () {
    AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $response = $this->get(route('psb.fee'));
    $response->assertOk();

    // Section 1: Banner & Breadcrumbs
    $response->assertSeeText('Rincian Biaya Pendidikan Santri')
        ->assertSee(route('psb.perlengkapan'), false);

    // Section 2: Ringkasan Biaya MTs & MDTA
    $response->assertSeeText('RINGKASAN BIAYA AWAL MASUK')
        ->assertSeeText('3.250.000')
        ->assertSeeText('3.350.000')
        ->assertSeeText('52.000');

    // Section 3: Tabel Rincian Biaya Lengkap (2 tab)
    $response->assertSeeText('TABEL RINCIAN BIAYA')
        ->assertSeeText('Rincian MTs (Mukim)')
        ->assertSeeText('Rincian MDTA (Non-Mukim)')
        ->assertSeeText('12 Komponen Biaya')
        ->assertSeeText('4 Komponen Biaya');

    // Section 4: Kebijakan Pembayaran & Rekening Resmi
    $response->assertSeeText('Kebijakan Pembayaran')
        ->assertSeeText('Rekening Resmi');

    // Equipment is NOT on this page anymore
    $response->assertDontSeeText('PERLENGKAPAN SANTRI BARU')
        ->assertDontSeeText('Seragam Pondok Formal')
        ->assertDontSeeText('Ketentuan Asrama & Barang Terlarang');
});

test('psb equipment page renders all 4 sections with complete categories and rules', function () {
    $response = $this->get(route('psb.perlengkapan'));
    $response->assertOk();

    // Section 1: Banner & Breadcrumbs
    $response->assertSeeText('Daftar Perlengkapan Santri Baru')
        ->assertSee(route('psb.fee'), false);

    // Section 2: Tab Santri Putra & Santri Putri with 4 categories
    $response->assertSeeText('RINCIAN 4 KATEGORI PERLENGKAPAN SANTRI')
        ->assertSeeText('Perlengkapan Santri Putra')
        ->assertSeeText('Perlengkapan Santri Putri')
        ->assertSeeText('Seragam Sekolah Formal')
        ->assertSeeText('Seragam Pondok Formal')
        ->assertSeeText('Perlengkapan Sholat & Ibadah')
        ->assertSeeText('Perlengkapan Sehari-hari & Asrama');

    // Section 3: Catatan Penting & Ketentuan Asrama
    $response->assertSeeText('Catatan Penting, Larangan & Ketentuan Asrama')
        ->assertSeeText('Barang yang DILARANG Dibawa')
        ->assertSeeText('Gawai & Elektronik')
        ->assertSeeText('Ketentuan & Rekomendasi Asrama');

    // Section 4: CTA Unduh & Kontak
    $response->assertSeeText('Siap Mempersiapkan Kedatangan Santri?')
        ->assertSee(route('psb.form'), false);
});

test('psb equipment route is also accessible via alias psb/equipment', function () {
    $response = $this->get('/psb/equipment');
    $response->assertOk()
        ->assertSeeText('Daftar Perlengkapan Santri Baru');
});

test('psb check status validates combination of registration number and nik', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $regNumber = 'PSB-2027-MTS-0123';
    $nik = '3201123456780001';

    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => $regNumber,
        'access_token' => 'SEC99999',
        'program_type' => 'MTS',
        'full_name' => 'Ahmad Fauzi',
        'nik' => $nik,
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SDIT Bogor',
        'address' => 'Jl. Raya Ciomas No. 12',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
    ]);

    ApplicantParent::create([
        'applicant_id' => $applicant->id,
        'father_name' => 'Fauzi Senior',
        'mother_name' => 'Siti Nurhaliza',
        'parent_phone' => '081234567890',
        'parent_address' => 'Jl. Raya Ciomas No. 12',
    ]);

    // 1. HTTP POST with valid combination
    $response = $this->post(route('psb.check-status'), [
        'registration_number' => $regNumber,
        'nik' => $nik,
    ]);
    $response->assertOk()
        ->assertSee('Ahmad Fauzi')
        ->assertSee($regNumber);

    // 2. HTTP POST with mismatched NIK fails
    $mismatchResponse = $this->post(route('psb.check-status'), [
        'registration_number' => $regNumber,
        'nik' => '3201999999999999',
    ]);
    $mismatchResponse->assertSessionHasErrors(['registration_number']);

    // 3. Livewire PsbCheckStatus with NIK
    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', $regNumber)
        ->set('nik', $nik)
        ->call('checkStatus')
        ->assertHasNoErrors()
        ->assertSee('Ahmad Fauzi')
        ->assertSee($regNumber);

    // 4. Livewire PsbCheckStatus with incorrect NIK
    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', $regNumber)
        ->set('nik', '3201000000000000')
        ->call('checkStatus')
        ->assertHasErrors(['registration_number']);

    // 5. Shorthand YYNNNN format (270123) finding PSB-2027-MTS-0123
    $shortReg = '270123';
    $responseShort = $this->post(route('psb.check-status'), [
        'registration_number' => $shortReg,
        'nik' => $nik,
    ]);
    $responseShort->assertOk()
        ->assertSee('Ahmad Fauzi')
        ->assertSee($regNumber);

    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', $shortReg)
        ->set('nik', $nik)
        ->call('checkStatus')
        ->assertHasNoErrors()
        ->assertSee('Ahmad Fauzi')
        ->assertSee($regNumber);

    // 6. Formatted NIK with dashes/spaces
    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', $shortReg)
        ->set('nik', ' 3201-1234-5678-0001 ')
        ->call('checkStatus')
        ->assertHasNoErrors()
        ->assertSee('Ahmad Fauzi');

    // 7. Whitespace-only input triggers validation errors
    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', '   ')
        ->set('nik', '   ')
        ->call('checkStatus')
        ->assertHasErrors(['registration_number', 'nik']);
});

test('psb registration allows father_no_wa when mother phone is provided', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 50,
        'max_quota_mdta' => 50,
    ]);

    Storage::fake('private');
    // 4MB file (> 2MB, < 5MB) to verify 5MB limit in Step 4
    $photo = UploadedFile::fake()->image('photo.jpg', 800, 800)->size(4000);
    $kk = UploadedFile::fake()->create('kk.pdf', 4000, 'application/pdf');

    Livewire::test(PsbRegistration::class)
        ->set('full_name', 'Santri Tanpa WA Ayah')
        ->set('nik', '3201888877776666')
        ->set('gender', 'L')
        ->set('birth_place', 'Serang')
        ->set('birth_date', '2014-01-01')
        ->set('child_order', 1)
        ->set('address', 'Kp. Lembur Sawah')
        ->call('nextStep')
        ->assertSet('step', 2)
        // With father_no_wa true and mother_phone filled, step 2 passes
        ->set('father_name', 'Ayah Tanpa HP')
        ->set('father_no_wa', true)
        ->set('parent_phone', '')
        ->set('mother_name', 'Ibu Ber-WA')
        ->set('mother_phone', '089655554444')
        ->call('nextStep')
        ->assertSet('step', 3)
        ->set('previous_school', 'SDN 1 Petir')
        ->set('program_type', 'MTS')
        ->call('nextStep')
        ->assertSet('step', 4)
        ->set('document_photo', $photo)
        ->set('document_kk', $kk)
        ->call('nextStep')
        ->assertSet('step', 5)
        ->set('agreement', true)
        ->call('submit')
        ->assertRedirect();

    $saved = Applicant::where('nik', '3201888877776666')->with('parent')->first();
    expect($saved)->not->toBeNull()
        ->and($saved->parent->parent_phone)->toBe('089655554444');
});

test('store applicant request accepts new demographic fields and files up to 2mb', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 50,
        'max_quota_mdta' => 50,
    ]);

    Storage::fake('private');
    // Valid 1.5MB files
    $photo = UploadedFile::fake()->image('foto_valid.jpg', 600, 600)->size(1500);
    $kk = UploadedFile::fake()->create('kk_valid.pdf', 1500, 'application/pdf');

    $response = $this->post(route('psb.store'), [
        'admission_wave_id' => $wave->id,
        'program_type' => 'MTS',
        'full_name' => 'Santri Direct Store',
        'nik' => '3201333344445555',
        'gender' => 'L',
        'birth_place' => 'Serang',
        'birth_date' => '2014-02-02',
        'child_order' => 2,
        'total_siblings' => 4,
        'previous_school' => 'SDN Mekar Baru',
        'school_level' => 'SD',
        'school_address' => 'Petir Serang',
        'address' => 'Jl. Lembur Sawah',
        'province' => 'Banten',
        'city' => 'Serang',
        'district' => 'Petir',
        'village' => 'Mekar Baru',
        'father_name' => 'Hasan',
        'father_status' => 'Hidup',
        'father_pesantren' => true,
        'mother_name' => 'Fatimah',
        'mother_status' => 'Hidup',
        'parent_phone' => '081234567899',
        'guardian_type' => 'ayah',
        'document_photo' => $photo,
        'document_kk' => $kk,
    ]);

    $response->assertRedirect();
    $applicant = Applicant::where('nik', '3201333344445555')->with('parent')->first();
    expect($applicant)->not->toBeNull()
        ->and($applicant->total_siblings)->toBe(4)
        ->and($applicant->province)->toBe('Banten')
        ->and($applicant->parent->father_pesantren)->toBeTrue();
});
