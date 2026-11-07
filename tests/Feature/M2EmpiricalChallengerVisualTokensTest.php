<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\AdmissionWave;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('landing page DOM contains all 4 design system hex color codes', function () {
    $response = $this->get('/');
    $response->assertOk();

    $content = $response->getContent();
    expect($content)->toBeString();

    // 1. #084C27 (brand-forest)
    expect(str_contains(strtoupper($content), '#084C27'))->toBeTrue(
        'The primary brand forest green (#084C27) must be present in rendered HTML'
    );

    // 2. #059669 (emerald-vibrant)
    expect(str_contains(strtoupper($content), '#059669'))->toBeTrue(
        'The vibrant emerald accent (#059669) must be present in rendered HTML'
    );

    // 3. #D97706 (gold-amber)
    expect(str_contains(strtoupper($content), '#D97706'))->toBeTrue(
        'The gold amber accent (#D97706) must be present in rendered HTML'
    );

    // 4. #FDFBF7 (surface-alabaster)
    expect(str_contains(strtoupper($content), '#FDFBF7'))->toBeTrue(
        'The warm alabaster surface neutral (#FDFBF7) must be present in rendered HTML'
    );
});

test('landing page and CSS bundle contain design system token bindings', function () {
    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Check token names in DOM or class names
    // 1. emerald
    expect(str_contains($content, 'emerald'))->toBeTrue('HTML must reference emerald token/utility');

    // 2. gold (e.g. border-gold-hairline or gold token)
    expect(str_contains($content, 'gold'))->toBeTrue('HTML must reference gold token/utility');

    // Verify app.css contains the theme tokens for forest, emerald, gold, alabaster
    $cssPath = resource_path('css/app.css');
    expect(file_exists($cssPath))->toBeTrue();
    $css = file_get_contents($cssPath);

    expect($css)->toContain('--color-brand-forest: #084C27;')
        ->and($css)->toContain('--color-emerald-vibrant: #059669;')
        ->and($css)->toContain('--color-gold-amber: #D97706;')
        ->and($css)->toContain('--color-surface-alabaster: #FDFBF7;');
});

test('hero Pengasuh portrait container applies rounded-arch class and hairline border', function () {
    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Verify rounded-arch class is applied to container elements
    expect(str_contains($content, 'rounded-arch'))->toBeTrue(
        'Hero section must include rounded-arch class on Pengasuh portrait container'
    );

    // Verify Pengasuh identity and arch styling
    expect(str_contains($content, 'Ust. Ahmad Ashil Fadhil, S.H., M.H.'))->toBeTrue();
    expect(str_contains($content, 'border-gold-hairline'))->toBeTrue();

    // Verify CSS rule for .rounded-arch definition
    $css = file_get_contents(resource_path('css/app.css'));
    expect($css)->toContain('.rounded-arch')
        ->and($css)->toContain('border-radius: 120px 120px 1rem 1rem;')
        ->and($css)->toContain('border-radius: 240px 240px 1.5rem 1.5rem;');
});

test('floating WhatsApp button has fixed bottom-6 right-6 z-50 and 56x56 circular geometry', function () {
    SiteSetting::set('psb_whatsapp_number', '6289912345678');

    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Verify fixed position classes
    expect(str_contains($content, 'fixed'))->toBeTrue();
    expect(str_contains($content, 'bottom-6'))->toBeTrue();
    expect(str_contains($content, 'right-6'))->toBeTrue();
    expect(str_contains($content, 'z-50'))->toBeTrue();

    // Verify geometry: w-14 (56px), h-14 (56px), rounded-full, whatsapp brand #25D366
    expect(str_contains($content, 'w-14'))->toBeTrue();
    expect(str_contains($content, 'h-14'))->toBeTrue();
    expect(str_contains($content, 'rounded-full'))->toBeTrue();
    expect(str_contains($content, '#25D366'))->toBeTrue();

    // Verify WhatsApp number binding
    expect(str_contains($content, '6289912345678'))->toBeTrue();
    expect(str_contains($content, 'animate-ping'))->toBeTrue('WhatsApp button must have pulse ring animation');
});

test('MTS Mukim and MDTA Sekolah Sore cards render strictly isolated details without cross-contamination', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(2)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 125000,
        'fee_mdta' => 35000,
    ]);

    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Load DOM into DOMDocument to query cards separately
    $dom = new \DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
    libxml_clear_errors();

    $xpath = new \DOMXPath($dom);

    // Find section with id="program"
    $programSection = $xpath->query('//section[@id="program"]');
    expect($programSection->length)->toBeGreaterThan(0);

    // Extract MTS and MDTA card text
    $mtsHeaders = $xpath->query('//h3[contains(text(), "MTS")]');
    $mdtaHeaders = $xpath->query('//h3[contains(text(), "MDTA")]');

    expect($mtsHeaders->length)->toBe(1);
    expect($mdtaHeaders->length)->toBe(1);

    $mtsCard = $mtsHeaders->item(0)->parentNode->parentNode->parentNode->parentNode;
    $mdtaCard = $mdtaHeaders->item(0)->parentNode->parentNode->parentNode->parentNode;

    $mtsText = $dom->saveHTML($mtsCard);
    $mdtaText = $dom->saveHTML($mdtaCard);

    // MTS Card Assertions:
    // 1. Badge: "Mukim" and "PROGRAM UNGGULAN MUKIM"
    expect($mtsText)->toContain('Mukim')
        ->and($mtsText)->toContain('PROGRAM UNGGULAN MUKIM')
        ->and($mtsText)->not->toContain('Non-Mukim')
        ->and($mtsText)->toContain('500.000') // Syahriah
        ->and($mtsText)->toContain('125.000') // Dynamic fee_mts
        ->and($mtsText)->not->toContain('35.000') // Must NOT contain fee_mdta
        ->and($mtsText)->toContain('Asrama mukim 24 jam')
        ->and($mtsText)->toContain('Ijazah formal Madrasah Tsanawiyah')
        ->and($mtsText)->not->toContain('Jadwal sekolah sore hari ba\'da Ashar')
        ->and($mtsText)->toContain('program=MTS');

    // MDTA Card Assertions:
    // 1. Badge: "Non-Mukim"
    expect($mdtaText)->toContain('Non-Mukim')
        ->and($mdtaText)->not->toContain('PROGRAM UNGGULAN MUKIM')
        ->and($mdtaText)->toContain('12.000') // SPP bulanan
        ->and($mdtaText)->toContain('35.000') // Dynamic fee_mdta
        ->and($mdtaText)->not->toContain('125.000') // Must NOT contain fee_mts
        ->and($mdtaText)->toContain('Jadwal sekolah sore hari ba\'da Ashar')
        ->and($mdtaText)->toContain('Madrasah Diniyah Takmiliyah Awaliyah')
        ->and($mdtaText)->not->toContain('Asrama mukim 24 jam')
        ->and($mdtaText)->toContain('program=MDTA');
});

test('mobile responsive navigation drawer and hamburger toggle structure exist in DOM', function () {
    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Verify Alpine.js mobile menu state binding
    expect($content)->toContain('x-data="{ mobileMenuOpen: false }"')
        ->and($content)->toContain('@click="mobileMenuOpen = !mobileMenuOpen"')
        ->and($content)->toContain('x-show="mobileMenuOpen"')
        ->and($content)->toContain('Buka Menu Navigasi');
});

test('public layout renders self-hosted font tags and semantic HTML structure', function () {
    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Verify layout tags
    expect($content)->toContain('<header')
        ->and($content)->toContain('<main')
        ->and($content)->toContain('<footer')
        ->and($content)->toContain('<aside');

    // Verify self-hosted font stylesheet is linked in <head>
    expect($content)->toContain('fonts');
});

test('WhatsApp button sanitizes complex phone numbers with symbols and whitespace in href wa.me while preserving display', function () {
    SiteSetting::set('psb_whatsapp_number', '+62 (812) 3456-7890');

    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // wa.me href must only contain numeric characters
    expect($content)->toContain('href="https://wa.me/6281234567890?text=')
        ->and($content)->toContain('+62 (812) 3456-7890');
});

test('empty database state displays dignified empty state cards matching design tokens without PHP notices', function () {
    // Ensure no teachers, no posts, no galleries, no waves
    Teacher::query()->delete();
    Post::query()->delete();
    Gallery::query()->delete();
    AdmissionWave::query()->delete();

    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Verify empty state messages and tokens
    expect($content)->toContain('Belum ada data asatidz yang dipublikasikan.')
        ->and($content)->toContain('Belum ada warta berita yang dipublikasikan.')
        ->and($content)->toContain('Belum ada dokumentasi kegiatan yang diunggah.')
        ->and($content)->toContain('#FDFBF7')
        ->and($content)->toContain('#084C27');
});

test('DOM heading hierarchy and Arabic typography diacritic clipping prevention', function () {
    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    $dom = new \DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
    libxml_clear_errors();

    $xpath = new \DOMXPath($dom);

    // Exactly one h1
    $h1s = $xpath->query('//h1');
    expect($h1s->length)->toBe(1);

    // Arabic institutional banners and Quranic citations must have dir="rtl" and line-height 1.8 to prevent diacritic clipping
    $arabicNodes = $xpath->query('//*[@dir="rtl"]');
    expect($arabicNodes->length)->toBeGreaterThan(4);

    $nodesWithLineHeight = 0;
    foreach ($arabicNodes as $node) {
        $style = $node->getAttribute('style');
        if (str_contains($style, 'line-height: 1.8;')) {
            $nodesWithLineHeight++;
        }
    }

    // At least 5 major institutional and Quranic citation containers enforce line-height: 1.8
    expect($nodesWithLineHeight)->toBeGreaterThanOrEqual(5);
});
