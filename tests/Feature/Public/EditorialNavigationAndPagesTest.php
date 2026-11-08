<?php

declare(strict_types=1);

namespace Tests\Feature\Public;

use App\Models\SiteSetting;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

test('homepage loads successfully with 200 OK and executive hub sections', function () {
    $response = $this->get('/');
    $response->assertOk();

    // Verify institutional brand and Pengasuh credentials
    $response->assertSeeText('Daar El Tazkiyah Sumardi')
        ->assertSeeText('Ust. Ahmad Ashil Fadhil, S.H., M.H.')
        ->assertSeeText('01 — PROFIL & NILAI UTAMA')
        ->assertSeeText('02 — PROGRAM AKADEMIK & KEHIDUPAN SANTRI')
        ->assertSeeText('03 — PENERIMAAN SANTRI BARU (PSB)')
        ->assertSeeText('04 — WARTA & DOKUMENTASI TERKINI');
});

test('profile sejarah page loads with comprehensive history and vision mission', function () {
    $response = $this->get('/profil/sejarah-visi-misi');
    $response->assertOk();

    $response->assertSeeText('Menempa Generasi Qur\'ani Berintegritas dan Berilmu Amaliah')
        ->assertSeeText('Titik Tolak & Sejarah Pendirian')
        ->assertSeeText('Melahirkan generasi Qur\'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat.')
        ->assertSeeText('Menanamkan kecintaan kepada Al-Qur\'an')
        ->assertSeeText('Membentuk akhlak mulia dan disiplin')
        ->assertSeeText('Memberikan pendidikan berkualitas berbasis Islam')
        ->assertSeeText('Mempersiapkan santri berprestasi di tingkat nasional');
});

test('profile teachers page displays dewan asatidz roster', function () {
    Teacher::create([
        'id' => (string) Str::ulid(),
        'full_name' => 'Ust. Muhammad Rizki, S.Pd.I., Al-Hafizh',
        'role_title' => 'Musyrif Tahfidz',
        'bio' => 'Hafizh 30 Juz Bersanad Qira\'at Ashim',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->get('/profil/dewan-asatidz');
    $response->assertOk();

    $response->assertSeeText('Dewan Asatidz & Tenaga Pendidik')
        ->assertSeeText('Ust. Ahmad Ashil Fadhil, S.H., M.H.')
        ->assertSeeText('Ust. Muhammad Rizki, S.Pd.I., Al-Hafizh');
});

test('profile facilities page displays campus infrastructure and amenities', function () {
    $response = $this->get('/profil/fasilitas');
    $response->assertOk();

    $response->assertSeeText('Sarana & Lingkungan Kampus Tahfidz')
        ->assertSeeText('Masjid Jami\' Pesantren')
        ->assertSeeText('Gedung Asrama Mukim 24 Jam')
        ->assertSeeText('Ruang Kelas & Belajar Terpadu')
        ->assertSeeText('Area Olahraga Sunnah & Ekstrakurikuler');
});

test('academic mts page displays full boarding syllabus and fee structure', function () {
    $response = $this->get('/akademik/mts-mukim');
    $response->assertOk();

    $response->assertSeeText('Madrasah Tsanawiyah (MTS Mukim 24 Jam)')
        ->assertSeeText('500.000')
        ->assertSeeText('Target Capaian Lulusan MTS (3 Tahun)')
        ->assertSeeText('Tahfidz 30 Juz Mutqin');
});

test('academic mdta page displays afternoon syllabus and schedule', function () {
    $response = $this->get('/akademik/mdta');
    $response->assertOk();

    $response->assertSeeText('Madrasah Diniyah Takmiliyah Awaliyah (MDTA Sekolah Sore)')
        ->assertSeeText('12.000')
        ->assertSeeText('Al-Qur\'an & Tajwid Praktis');
});

test('academic tahfidz page displays sabaq manzil methodology and matan tajwid', function () {
    $response = $this->get('/akademik/kurikulum-tahfidz');
    $response->assertOk();

    $response->assertSeeText('Kurikulum Tahfidz 30 Juz & Kitab Kuning Salaf')
        ->assertSeeText('Sabaq (Setoran Baru)')
        ->assertSeeText('Sabqi (Muraja\'ah Dekat)')
        ->assertSeeText('Manzil (Muraja\'ah Total)')
        ->assertSeeText('Matan Tuhfatul Athfal')
        ->assertSeeText('Mandzumah Al-Jazariyah')
        ->assertSeeText('At-Tibyan fi Adabi Hamalatil Quran');
});

test('contact page loads campus address and reservation form', function () {
    SiteSetting::set('school_address', 'Jl. Cibanteng Babengket, Desa Cihideung Udik, Ciampea Bogor');
    SiteSetting::set('school_phone', '0812-9999-8888');

    $response = $this->get('/kontak');
    $response->assertOk();

    $response->assertSeeText('Kunjungi Kampus Kami di Ciampea, Bogor')
        ->assertSeeText('Formulir Reservasi Silaturahmi')
        ->assertSeeText('0812-9999-8888')
        ->assertSeeText('Cihideung Udik, Ciampea Bogor');
});

test('contact consultation form validates and redirects to WhatsApp hotline', function () {
    SiteSetting::set('psb_whatsapp_number', '6281234567890');

    $response = $this->post('/kontak/konsultasi', [
        'parent_name' => 'Bapak Ahmad Fauzi',
        'phone' => '08123456789',
        'program_interest' => 'MTS',
        'visit_date' => now()->addDays(3)->toDateString(),
        'notes' => 'Ingin survei kamar asrama dan masjid',
    ]);

    $response->assertRedirect();
    $targetUrl = $response->headers->get('Location');
    expect($targetUrl)->toContain('wa.me/6281234567890')
        ->and($targetUrl)->toContain(urlencode('Bapak Ahmad Fauzi'));
});
