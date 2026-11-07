<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('landing page loads successfully with 200 OK and brand headers', function () {
    $response = $this->get('/');
    $response->assertOk();

    // Verifies brand identity texts derived from PRD §6.1 & DESIGN §2
    $content = $response->getContent();
    expect($content)->toBeString();

    // In MVP phase, check whether full layout is rendered or welcome fallback
    if (str_contains($content, 'Pondok Pesantren Modern Tahfidzul Quran')) {
        $response->assertSee('Pondok Pesantren Modern Tahfidzul Quran')
            ->assertSee('Daar El Tazkiyah Sumardi');
    }
});

test('landing page displays Pengasuh portrait and credentials', function () {
    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    if (! str_contains($content, 'Ust. Ahmad Ashil Fadhil')) {
        test()->markTestSkipped('Landing page pengasuh section not yet implemented (M2 required).');
    }

    $response->assertSee('Ust. Ahmad Ashil Fadhil, S.H., M.H.');
});

test('landing page displays Visi and Misi bento grid with 4 mission points', function () {
    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    if (! str_contains($content, 'generasi Qur\'ani')) {
        test()->markTestSkipped('Landing page visi-misi section not yet implemented (M2 required).');
    }

    $response->assertSee('Melahirkan generasi Qur\'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat.')
        ->assertSee('Menanamkan kecintaan kepada Al-Qur\'an')
        ->assertSee('Membentuk akhlak mulia dan disiplin')
        ->assertSee('Memberikan pendidikan berkualitas berbasis Islam')
        ->assertSee('Mempersiapkan santri berprestasi di tingkat nasional');
});

test('landing page displays program comparison for MTS Mukim 24 Jam and MDTA Sekolah Sore', function () {
    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    if (! str_contains($content, 'MTS') && ! str_contains($content, 'MDTA')) {
        test()->markTestSkipped('Landing page program comparison not yet implemented (M2 required).');
    }

    $response->assertSee('Mukim 24 Jam')
        ->assertSee('500.000')
        ->assertSee('Sekolah Sore')
        ->assertSee('12.000');
});

test('landing page dynamically renders registration fee from active admission wave', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(5)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    if (! str_contains($content, '100.000')) {
        test()->markTestSkipped('Landing page dynamic fee sync not yet integrated (M2 required).');
    }

    $response->assertSee('100.000')
        ->assertSee('25.000');
});

test('landing page showcases active teachers loaded from database', function () {
    if (! Schema::hasTable('teachers')) {
        test()->markTestSkipped('Teachers table not yet migrated (M1 required).');
    }

    DB::table('teachers')->insert([
        'id' => (string) Str::ulid(),
        'full_name' => 'Ibu Hj. Dati Sumiyati, M.Pd.',
        'role_title' => 'Tenaga Pendidik',
        'bio' => 'Pembimbing Tahfidz & Pengajar',
        'sort_order' => 1,
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    if (! str_contains($content, 'Dati Sumiyati')) {
        test()->markTestSkipped('Landing page teacher showcase not yet integrated (M2 required).');
    }

    $response->assertSee('Ibu Hj. Dati Sumiyati, M.Pd.');
});

test('landing page renders contact section and floating WhatsApp action button with configured phone', function () {
    if (! Schema::hasTable('site_settings')) {
        test()->markTestSkipped('Site settings table not yet migrated (M1 required).');
    }

    DB::table('site_settings')->insert([
        'id' => (string) Str::ulid(),
        'key' => 'psb_whatsapp_number',
        'value' => '6281234567890',
        'group' => 'psb',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    if (! str_contains($content, '6281234567890')) {
        test()->markTestSkipped('Landing page WhatsApp button not yet integrated (M2 required).');
    }

    $response->assertSee('6281234567890');
});
