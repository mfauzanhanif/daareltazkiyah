<?php

declare(strict_types=1);

use App\Enums\SettingGroup;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\SiteSetting;
use Illuminate\Support\Str;

test('homepage program pendidikan section displays concise descriptions and buttons without financial figures', function () {
    $response = $this->get(route('home'));
    $response->assertOk();

    $content = $response->getContent();

    // Verify program names and concise descriptions
    expect($content)->toContain('MTS (Madrasah Tsanawiyah)')
        ->and($content)->toContain('MDTA (Madrasah Diniyah Takmiliyah Awaliyah)')
        ->and($content)->toContain('Pendidikan formal tingkat menengah pertama terpadu asrama mukim 24 jam')
        ->and($content)->toContain('Pendidikan keagamaan Islam non-mukim sore hari bagi santri usia SD/MI');

    // Verify exactly 3 buttons/links in Program Pendidikan: Detail MTs (/mts), Detail MDTA (/mdta), and Daftar Santri Baru (/psb/formulir)
    expect($content)->toContain(route('mts.index'))
        ->and($content)->toContain(route('mdta.index'))
        ->and($content)->toContain(route('psb.form'));

    // Verify absence of fees / financial figures in Program Pendidikan section
    // Extract Section 5 HTML block
    preg_match('/<section id="program".*?<\/section>/s', $content, $matches);
    expect($matches)->not->toBeEmpty();
    $programSection = $matches[0];

    expect($programSection)->not->toContain('500.000')
        ->and($programSection)->not->toContain('12.000')
        ->and($programSection)->not->toContain('Rp ')
        ->and($programSection)->not->toContain('iuran')
        ->and($programSection)->toContain('Detail Program MTs')
        ->and($programSection)->toContain('Detail Program MDTA')
        ->and($programSection)->toContain('Daftar Santri Baru Sekarang');
});

test('homepage gallery section renders looping marquee with backend photos and titles only', function () {
    // Seed test galleries with quotes and special characters to test escaping safety
    $gallery1 = Gallery::create([
        'id' => (string) Str::ulid(),
        'title' => "Tasmi' Akbar & Hafalan 30 Juz \"Sekali Duduk\"",
        'slug' => 'tasmi-akbar-hafalan-30-juz-test',
        'cover_image' => 'galleries/test-tasmi.webp',
        'description' => 'Deskripsi rahasia yang tidak boleh tampil di kartu galeri utama',
        'sort_order' => 1,
        'is_published' => true,
    ]);

    $gallery2 = Gallery::create([
        'id' => (string) Str::ulid(),
        'title' => 'Rihlah Ilmiah Santri Mandiri',
        'slug' => 'rihlah-ilmiah-test',
        'cover_image' => null,
        'description' => 'Deskripsi lain yang juga tersembunyi',
        'sort_order' => 2,
        'is_published' => true,
    ]);

    GalleryPhoto::create([
        'id' => (string) Str::ulid(),
        'gallery_id' => $gallery2->id,
        'file_path' => 'galleries/rihlah-photo-1.webp',
        'sort_order' => 1,
    ]);

    $response = $this->get(route('home'));
    $response->assertOk();

    $content = $response->getContent();

    // Verify marquee container and infinite loop cloned tracks
    expect($content)->toContain('animate-marquee-left')
        ->and($content)->toContain('aria-hidden="true"')
        ->and($content)->toContain('Buka Galeri Foto Lengkap')
        ->and($content)->toContain(route('gallery.index'));

    // Extract Gallery section HTML block
    preg_match('/<section[^>]*id="kehidupan-santri"[^>]*>.*?<\/section>/s', $content, $matches);
    expect($matches)->not->toBeEmpty();
    $gallerySection = $matches[0];

    // Titles must be visible
    expect($gallerySection)->toContain('Tasmi&#039; Akbar &amp; Hafalan 30 Juz &quot;Sekali Duduk&quot;')
        ->and($gallerySection)->toContain('Rihlah Ilmiah Santri Mandiri');

    // Descriptions must NOT be visible
    expect($gallerySection)->not->toContain('Deskripsi rahasia yang tidak boleh tampil')
        ->and($gallerySection)->not->toContain('Deskripsi lain yang juga tersembunyi');

    // Images must be sourced from backend storage / photos relation
    expect($gallerySection)->toContain('galleries/test-tasmi.webp')
        ->and($gallerySection)->toContain('galleries/rihlah-photo-1.webp');

    // Interactive Alpine openModal handler must be present with proper escaping
    expect($gallerySection)->toContain('openModal(')
        ->and($gallerySection)->toContain('@keydown.space.prevent="openModal(');
});

test('homepage gallery section handles empty galleries gracefully', function () {
    Gallery::query()->delete();

    $response = $this->get(route('home'));
    $response->assertOk();

    $response->assertSee('Belum ada dokumentasi kegiatan yang diunggah.')
        ->assertDontSee('animate-marquee-left');
});

test('homepage has standalone PSB and social media sections removed', function () {
    $response = $this->get(route('home'));
    $response->assertOk();

    $content = $response->getContent();

    // Standalone PSB section ID and headings must not exist
    expect($content)->not->toContain('id="informasi-psb"')
        ->and($content)->not->toContain('HIGHLIGHT INFORMASI BIAYA PSB')
        ->and($content)->not->toContain('SOSIAL MEDIA SECTION (3 KOLOM SEIMBANG)');
});

test('homepage CTA section has contrasting Warm Alabaster background, action buttons, and social media channels', function () {
    SiteSetting::updateOrCreate(
        ['key' => 'instagram_url'],
        ['value' => 'https://instagram.com/custom_daareltazkiyah', 'group' => SettingGroup::SocialMedia]
    );
    SiteSetting::updateOrCreate(
        ['key' => 'tiktok_url'],
        ['value' => 'https://tiktok.com/@custom_daareltazkiyah', 'group' => SettingGroup::SocialMedia]
    );
    SiteSetting::updateOrCreate(
        ['key' => 'facebook_url'],
        ['value' => 'https://facebook.com/custom_daareltazkiyah', 'group' => SettingGroup::SocialMedia]
    );
    SiteSetting::updateOrCreate(
        ['key' => 'psb_whatsapp_number'],
        ['value' => '081234567890', 'group' => SettingGroup::Psb]
    );

    $response = $this->get(route('home'));
    $response->assertOk();

    $content = $response->getContent();

    // Extract CTA section
    preg_match('/<!-- 7\. CTA SECTION.*?<\/section>/s', $content, $matches);
    expect($matches)->not->toBeEmpty();
    $ctaSection = $matches[0];

    // Verify contrast background: Warm Ivory #FAF8F5, NOT footer's dark green #084C27
    expect($ctaSection)->toContain('bg-[#FAF8F5]')
        ->and($ctaSection)->not->toContain('bg-[#084C27]');

    // Verify Action buttons
    expect($ctaSection)->toContain(route('psb.form'))
        ->and($ctaSection)->toContain('Daftar Sekarang')
        ->and($ctaSection)->toContain('https://api.whatsapp.com/send/?phone=081234567890')
        ->and($ctaSection)->toContain('Hubungi Kami');

    // Verify integrated social media channels
    expect($ctaSection)->toContain('https://instagram.com/custom_daareltazkiyah')
        ->and($ctaSection)->toContain('https://tiktok.com/@custom_daareltazkiyah')
        ->and($ctaSection)->toContain('https://facebook.com/custom_daareltazkiyah')
        ->and($ctaSection)->toContain('Instagram')
        ->and($ctaSection)->toContain('TikTok')
        ->and($ctaSection)->toContain('Facebook');
});

test('css app contains x-cloak rule and marquee animations with focus and reduced motion support', function () {
    $cssContent = file_get_contents(resource_path('css/app.css'));

    expect($cssContent)->toContain('[x-cloak]')
        ->and($cssContent)->toContain('display: none !important;')
        ->and($cssContent)->toContain('@keyframes marqueeLeft')
        ->and($cssContent)->toContain('.animate-marquee-left')
        ->and($cssContent)->toContain('animation-play-state: paused;')
        ->and($cssContent)->toContain(':focus-within')
        ->and($cssContent)->toContain('prefers-reduced-motion');
});
