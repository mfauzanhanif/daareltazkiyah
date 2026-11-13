<?php

declare(strict_types=1);

namespace Tests\Feature\Public;

use App\Models\AdmissionWave;
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
        ->assertSeeText('PROGRAM UNGGULAN')
        ->assertSeeText('VISI & MISI')
        ->assertSeeText('Warta Pesantren & Agenda Kegiatan')
        ->assertSeeText('Potret Rutinitas & Kehidupan Santri')
        ->assertSeeText('PROGRAM PENDIDIKAN');
});

test('profile page loads with comprehensive history and vision mission anchors', function () {
    $response = $this->get('/profil');
    $response->assertOk();

    $response->assertSeeText('Pondok Pesantren Modern Tahfidzul Qur\'an Daar El Tazkiyah Sumardi')
        ->assertSeeText('Melahirkan generasi Qur\'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi untuk umat.')
        ->assertSeeText('Menanamkan kecintaan kepada Al-Qur\'an')
        ->assertSeeText('Membentuk akhlak mulia dan disiplin')
        ->assertSeeText('Memberikan pendidikan berkualitas berbasis Islam')
        ->assertSeeText('Mempersiapkan santri berprestasi di tingkat nasional')
        ->assertSee('id="selayang-pandang"', false)
        ->assertSee('id="visi-misi"', false)
        ->assertSee('id="fasilitas"', false)
        ->assertSee('id="pendidik"', false);
});

test('profile page displays dewan asatidz roster and pengasuh', function () {
    Teacher::create([
        'id' => (string) Str::ulid(),
        'full_name' => 'Ust. Muhammad Rizki, S.Pd.I., Al-Hafizh',
        'role_title' => 'Musyrif Tahfidz',
        'bio' => 'Hafizh 30 Juz',
        'sort_order' => 10,
        'is_active' => true,
    ]);

    $response = $this->get('/profil');
    $response->assertOk();

    $response->assertSeeText('Ust. Ahmad Ashil Fadhil, S.H., M.H.')
        ->assertSeeText('Ust. Muhammad Rizki, S.Pd.I., Al-Hafizh');
});

test('profile page displays facilities infrastructure and amenities', function () {
    $response = $this->get('/profil');
    $response->assertOk();

    $response->assertSeeText('Ruang Kelas yang Nyaman')
        ->assertSeeText('Masjid Jami\' Pesantren')
        ->assertSeeText('Gedung Asrama Santri')
        ->assertSeeText('Perpustakaan & Ruang Baca')
        ->assertSeeText('Unit Kesehatan Santri (UKS)')
        ->assertSeeText('Dapur Umum Higienis')
        ->assertSeeText('Kantin & Koperasi Santri');
});

test('program page displays 6 program unggulan, cta for mts and mdta, and extracurriculars', function () {
    $response = $this->get('/program');
    $response->assertOk();

    $response->assertSeeText('Tahfidz Al-Qur\'an')
        ->assertSeeText('Tahfidz Hadits')
        ->assertSeeText('Kajian Kitab Kuning')
        ->assertSeeText('Bahasa Arab & Inggris')
        ->assertSeeText('Public Speaking & Da\'wah')
        ->assertSeeText('Pembinaan Akhlak & Kedisiplinan')
        ->assertSeeText('Pencak Silat')
        ->assertSeeText('Hadroh & Rebana')
        ->assertSeeText('Kaligrafi (Khattil Qur\'an)')
        ->assertSeeText('Seni Baca Al-Qur\'an (Tilawah)')
        ->assertSeeText('Futsal & Olahraga')
        ->assertSeeText('Pramuka Santri')
        ->assertDontSee('id="program-unggulan"', false)
        ->assertSee('id="program-pendidikan"', false)
        ->assertSee('id="ekstrakurikuler"', false)
        ->assertDontSeeText('KEGIATAN MINGGUAN')
        ->assertDontSeeText('AGENDA SENI & KULTUR')
        ->assertSee(route('mts.index'), false)
        ->assertSee(route('mdta.index'), false);
});

test('program page does not display fees and provides cta to mts and mdta', function () {
    $response = $this->get('/program');
    $response->assertOk();

    $response->assertSeeText('MTs (Madrasah Tsanawiyah)')
        ->assertSeeText('MDTA (Madrasah Diniyah Takmiliyah Awaliyah)')
        ->assertDontSeeText('500.000')
        ->assertDontSeeText('12.000')
        ->assertSeeText('Pelajari Selengkapnya MTs')
        ->assertSeeText('Pelajari Selengkapnya MDTA');
});

test('mts page loads successfully with banner, description, and curriculum', function () {
    $response = $this->get('/mts');
    $response->assertOk();

    $response->assertSeeText('Madrasah Tsanawiyah (MTs)')
        ->assertSeeText('Pendidikan Formal Asrama 24 Jam')
        ->assertSeeText('DESKRIPSI PROGRAM MTS')
        ->assertSeeText('KURIKULUM PEMBELAJARAN MTS')
        ->assertSeeText('Kurikulum Formal Kemenag RI & Nasional')
        ->assertSeeText('Tahfidzul Qur\'an & Ulumul Qur\'an')
        ->assertSeeText('Kajian Kitab Kuning (Turats Salaf)')
        ->assertSeeText('Bahasa Asing Aktif & Kepemimpinan')
        ->assertSee(route('psb.form', ['program' => 'MTS']), false);
});

test('mdta page loads successfully with banner, description, curriculum, schedule, and hafalan targets', function () {
    $response = $this->get('/mdta');
    $response->assertOk();

    $response->assertSeeText('Madrasah Diniyah Takmiliyah Awaliyah (MDTA)')
        ->assertSeeText('DESKRIPSI PROGRAM MDTA')
        ->assertSeeText('MDT Ula DAAR EL TAZKIYAH SUMARDI')
        ->assertSeeText('311236041251')
        ->assertSeeText('KURIKULUM PEMBELAJARAN MDTA')
        ->assertSeeText('Baca Tulis Al-Qur\'an (BTQ)')
        ->assertSeeText('Tahfidz Al-Qur\'an')
        ->assertSeeText('Aqidah Akhlak')
        ->assertSeeText('Fiqih')
        ->assertSeeText('Sejarah Kebudayaan Islam (SKI)')
        ->assertSeeText('Bahasa Arab')
        ->assertSeeText('Praktik Ibadah dan Doa Harian')
        ->assertSeeText('JADWAL PELAJARAN HARIAN')
        ->assertSeeText('TARGET HAFALAN BERJENJANG MDTA')
        ->assertSeeText('Kelas 1 MDTA')
        ->assertSeeText('Kelas 2 MDTA')
        ->assertSeeText('Kelas 3 MDTA')
        ->assertSee(route('psb.form', ['program' => 'MDTA']), false);
});

test('navigation header includes revised program menu links', function () {
    $response = $this->get('/program');
    $response->assertOk();

    $response->assertSee(route('program.index'), false)
        ->assertSee(route('mts.index'), false)
        ->assertSee(route('mdta.index'), false)
        ->assertSee(route('program.index').'#ekstrakurikuler', false)
        ->assertSeeText('MTS')
        ->assertSeeText('MDTA')
        ->assertSeeText('Ekstrakurikuler');
});

test('gallery page loads with pinterest masonry layout and category filter tabs', function () {
    $response = $this->get('/galeri');
    $response->assertOk();

    $response->assertSeeText('Potret Rutinitas & Dokumentasi Santri')
        ->assertSeeText('Pinterest Masonry Grid')
        ->assertSeeText('Semua Galeri')
        ->assertSeeText('Tahfidz & Tasmi\'')
        ->assertSeeText('Kegiatan Santri')
        ->assertSeeText('Prestasi & Lomba');
});

test('contact page loads Serang Banten campus address and dual hotlines', function () {
    SiteSetting::set('school_address', 'RT 006 / RW 002, Kp. Lembur Sawah, Desa Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten');
    SiteSetting::set('school_phone', '0896-5332-4339');
    SiteSetting::set('psb_whatsapp_mdta_number', '0895-0718-4811');

    $response = $this->get('/kontak');
    $response->assertOk();

    $response->assertSeeText('0896-5332-4339')
        ->assertSeeText('0895-0718-4811')
        ->assertSeeText('Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten');
});

test('contact consultation form validates and redirects to WhatsApp hotline', function () {
    SiteSetting::set('psb_whatsapp_number', '089653324339');

    $response = $this->post('/kontak/konsultasi', [
        'parent_name' => 'Bapak Ahmad Fauzi',
        'phone' => '08123456789',
        'program_interest' => 'MTS',
        'visit_date' => now()->addDays(3)->toDateString(),
        'notes' => 'Ingin survei kamar asrama dan masjid',
    ]);

    $response->assertRedirect();
    $targetUrl = $response->headers->get('Location');
    expect($targetUrl)->toContain('wa.me/6289653324339')
        ->and($targetUrl)->toContain(urlencode('Bapak Ahmad Fauzi'));
});

test('psb information landing page loads with wave details and direct cta to form', function () {
    AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 125000,
        'fee_mdta' => 35000,
    ]);

    $response = $this->get(route('psb.index'));
    $response->assertOk()
        ->assertSeeText('ALUR PENDAFTARAN SANTRI')
        ->assertSeeText('RINGKASAN BIAYA PENDIDIKAN')
        ->assertSeeText('PERSYARATAN DOKUMEN')
        ->assertSeeText('PERTANYAAN SEPUTAR PSB')
        ->assertSee(route('psb.form'), false);
});

test('psb registration form route loads standalone wizard view with breadcrumbs', function () {
    $response = $this->get(route('psb.form'));
    $response->assertOk()
        ->assertSeeText('FORMULIR PENDAFTARAN RESMI')
        ->assertSee(route('psb.index'), false);
});

test('navigation header contains PSB submenu pointing to psb.index, psb.fee, psb.perlengkapan, psb.status and Daftar CTA pointing to psb.form', function () {
    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    expect($content)->toContain('href="'.route('psb.index').'"')
        ->and($content)->toContain('href="'.route('psb.fee').'"')
        ->and($content)->toContain('href="'.route('psb.perlengkapan').'"')
        ->and($content)->toContain('href="'.route('psb.status').'"')
        ->and($content)->toContain('href="'.route('psb.form').'"');
});

test('psb fee and equipment routes load successfully with fee tables and equipment breakdown', function () {
    AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 125000,
        'fee_mdta' => 35000,
    ]);

    $response = $this->get(route('psb.fee'));
    $response->assertOk()
        ->assertSeeText('Rincian Biaya')
        ->assertSeeText('RINGKASAN BIAYA AWAL MASUK')
        ->assertSeeText('TABEL RINCIAN BIAYA')
        ->assertSeeText('125.000')
        ->assertSeeText('35.000')
        ->assertSee(route('psb.form'), false);

    $responseEquip = $this->get(route('psb.perlengkapan'));
    $responseEquip->assertOk()
        ->assertSeeText('Perlengkapan Santri')
        ->assertSeeText('Perlengkapan Santri Putra')
        ->assertSeeText('Perlengkapan Santri Putri')
        ->assertSeeText('Seragam Sekolah Formal')
        ->assertSeeText('Seragam Pondok Formal')
        ->assertSeeText('Catatan Penting, Larangan & Ketentuan Asrama')
        ->assertSee(route('psb.form'), false);
});
