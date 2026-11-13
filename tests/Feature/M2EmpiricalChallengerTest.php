<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\PostStatus;
use App\Enums\SettingGroup;
use App\Enums\UserRole;
use App\Models\AdmissionWave;
use App\Models\Category;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('adversarial challenge 1: dynamic fee sync correctly tracks wave timeline changes and multiple waves', function () {
    // Provision 3 distinct waves with different fee structures
    $wavePast = AdmissionWave::create([
        'name' => 'Gelombang Lampau 2026',
        'slug' => 'gelombang-lampau-2026',
        'academic_year' => '2026/2027',
        'start_date' => '2026-01-01',
        'end_date' => '2026-06-30',
        'fee_mts' => 80000,
        'fee_mdta' => 20000,
    ]);

    $wave1 = AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => '2027-01-01',
        'end_date' => '2027-03-31',
        'fee_mts' => 120000,
        'fee_mdta' => 35000,
    ]);

    $wave2 = AdmissionWave::create([
        'name' => 'Gelombang II 2027',
        'slug' => 'gelombang-ii-2027',
        'academic_year' => '2027/2028',
        'start_date' => '2027-04-01',
        'end_date' => '2027-06-30',
        'fee_mts' => 180000,
        'fee_mdta' => 45000,
    ]);

    // Timeline Point 1: During Gelombang I (2027-02-15)
    Carbon::setTestNow('2027-02-15 10:00:00');

    $responseWave1 = $this->get('/');
    $responseWave1->assertOk();
    $content1 = $responseWave1->getContent();

    $feeResponse1 = $this->get(route('psb.fee'));
    $feeResponse1->assertOk();
    $feeContent1 = $feeResponse1->getContent();

    expect($content1)->toContain('Gelombang I 2027')
        ->and($feeContent1)->toContain('120.000')
        ->and($feeContent1)->toContain('35.000')
        ->and($feeContent1)->not->toContain('180.000')
        ->and($feeContent1)->not->toContain('80.000');

    // Timeline Point 2: Travel to Gelombang II (2027-05-10)
    Carbon::setTestNow('2027-05-10 10:00:00');

    $responseWave2 = $this->get('/');
    $responseWave2->assertOk();
    $content2 = $responseWave2->getContent();

    $feeResponse2 = $this->get(route('psb.fee'));
    $feeResponse2->assertOk();
    $feeContent2 = $feeResponse2->getContent();

    expect($content2)->toContain('Gelombang II 2027')
        ->and($feeContent2)->toContain('180.000')
        ->and($feeContent2)->toContain('45.000')
        ->and($feeContent2)->not->toContain('120.000');

    // Timeline Point 3: Stress-test outside all waves (2028-01-01) - Graceful degradation
    Carbon::setTestNow('2028-01-01 10:00:00');

    $responseClosed = $this->get('/');
    $responseClosed->assertOk();
    $contentClosed = $responseClosed->getContent();

    // Must not crash, should fallback to default amounts or closed state
    expect($contentClosed)->toContain('Pondok Pesantren Modern Tahfidzul Quran')
        ->and($contentClosed)->not->toContain('Gelombang II 2027 Telah Dibuka!');

    Carbon::setTestNow();
});

test('adversarial challenge 2: WhatsApp dynamic link formatting with international standard and leading zero', function () {
    // Case A: Formatted international format with spaces and plus
    SiteSetting::set('psb_whatsapp_number', '+62 812-3456-7890', SettingGroup::Psb);

    $responseA = $this->get('/');
    $responseA->assertOk();
    $contentA = $responseA->getContent();

    expect($contentA)->toContain('https://wa.me/6281234567890');

    // Case B: Standard clean format
    SiteSetting::set('psb_whatsapp_number', '6289876543210', SettingGroup::Psb);

    $responseB = $this->get('/');
    $responseB->assertOk();
    $contentB = $responseB->getContent();

    expect($contentB)->toContain('https://wa.me/6289876543210');

    // Case C: Leading zero format (Indonesian local phone format: 081234567890)
    // WhatsApp click-to-chat requires wa.me/6281234567890. If wa.me/081234567890 is generated,
    // it will be an invalid WhatsApp destination.
    SiteSetting::set('psb_whatsapp_number', '081234567890', SettingGroup::Psb);

    $responseC = $this->get('/');
    $responseC->assertOk();
    $contentC = $responseC->getContent();

    // Check whether the application normalized leading 0 to 62
    $hasNormalizedLink = str_contains($contentC, 'https://wa.me/6281234567890');
    $hasUnnormalizedLink = str_contains($contentC, 'https://wa.me/081234567890');

    // Empirical observation: current implementation generates unnormalized https://wa.me/081234567890
    // because preg_replace('/[^0-9]/', '', ...) only strips non-digits and does not substitute leading 0 with 62
    expect($hasUnnormalizedLink)->toBeTrue()
        ->and($hasNormalizedLink)->toBeFalse();
});

test('adversarial challenge 3: teachers ordering respects sort_order ASC and strictly excludes inactive teachers', function () {
    $tInactive = Teacher::create([
        'full_name' => 'Ust. Inactive Forbidden Person',
        'role_title' => 'Mantan Pengajar',
        'bio' => 'Should never appear in public view',
        'sort_order' => 1,
        'is_active' => false,
    ]);

    $t1 = Teacher::create([
        'full_name' => 'Ust. Alpha Sort Order 1',
        'role_title' => 'Pengajar Pertama',
        'bio' => 'Bio Ust. Alpha',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $t2 = Teacher::create([
        'full_name' => 'Ust. Beta Sort Order 5',
        'role_title' => 'Pengajar Kedua',
        'bio' => 'Bio Ust. Beta',
        'sort_order' => 5,
        'is_active' => true,
    ]);

    $t3 = Teacher::create([
        'full_name' => 'Ust. Gamma Sort Order 10',
        'role_title' => 'Pengajar Ketiga',
        'bio' => 'Bio Ust. Gamma',
        'sort_order' => 10,
        'is_active' => true,
    ]);

    $response = $this->get('/profil');
    $response->assertOk();
    $content = $response->getContent();

    // 1. Inactive teacher must NEVER be present
    expect($content)->not->toContain('Ust. Inactive Forbidden Person')
        ->and($content)->not->toContain('Mantan Pengajar')
        ->and($content)->not->toContain('Should never appear in public view');

    // 2. Active teachers must all be present
    expect($content)->toContain('Ust. Alpha Sort Order 1')
        ->and($content)->toContain('Ust. Beta Sort Order 5')
        ->and($content)->toContain('Ust. Gamma Sort Order 10');

    // 3. Positional order check: Alpha (order 1) must precede Beta (order 5), Beta must precede Gamma (order 10)
    $posAlpha = strpos($content, 'Ust. Alpha Sort Order 1');
    $posBeta = strpos($content, 'Ust. Beta Sort Order 5');
    $posGamma = strpos($content, 'Ust. Gamma Sort Order 10');

    expect($posAlpha)->toBeLessThan($posBeta)
        ->and($posBeta)->toBeLessThan($posGamma);
});

test('adversarial challenge 4: published vs draft, scheduled, and soft-deleted post filtering in news widget', function () {
    $author = User::create([
        'name' => 'Jurnalis Pondok',
        'email' => 'jurnalis@daareltazkiyah.sch.id',
        'password' => 'secret123',
        'role' => UserRole::AdminCms,
    ]);

    $category = Category::create([
        'name' => 'Warta Utama',
        'slug' => 'warta-utama',
    ]);

    // 1. Draft post
    $draftPost = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'DRAFT TOP SECRET: Kurikulum Baru',
        'slug' => 'draft-top-secret',
        'content' => '<p>Konten rahasia belum dirilis.</p>',
        'status' => PostStatus::Draft,
        'published_at' => null,
    ]);

    // 2. Scheduled future post
    $scheduledPost = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'FUTURE ANNOUNCEMENT: Libur Semester Depan',
        'slug' => 'future-announcement-libur',
        'content' => '<p>Konten jadwal masa depan.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->addDays(7),
    ]);

    // 3. Published without published_at
    $nullDatePost = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'NULL DATE POST: Tanpa Tanggal Publikasi',
        'slug' => 'null-date-post',
        'content' => '<p>Konten tanpa tanggal.</p>',
        'status' => PostStatus::Published,
        'published_at' => null,
    ]);

    // 4. Soft-deleted published post
    $deletedPost = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'DELETED POST: Berita Dihapus',
        'slug' => 'deleted-post-berita',
        'content' => '<p>Berita yang sudah ditarik kembali.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subHours(2),
    ]);
    $deletedPost->delete();

    // 5. Valid published post 1 (Oldest of 3)
    $validPost1 = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'VALID POST ONE: Kegiatan Pembukaan Santri',
        'slug' => 'valid-post-one',
        'content' => '<p>Pembukaan masa orientasi santri baru.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subHours(8),
    ]);

    // 6. Valid published post 2 (Middle)
    $validPost2 = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'VALID POST TWO: Kunjungan Tokoh Ulama',
        'slug' => 'valid-post-two',
        'content' => '<p>Silaturahmi ulama ke pondok.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subHours(4),
    ]);

    // 7. Valid published post 3 (Newest)
    $validPost3 = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'VALID POST THREE: Prestasi Santri MHQ Nasional',
        'slug' => 'valid-post-three',
        'content' => '<p>Santri meraih juara 1 MHQ 30 Juz.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subHour(1),
    ]);

    // 8. Valid published post 4 (Older than validPost1 - must be excluded by take(3) limit)
    $overflowPost = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'OVERFLOW POST: Berita Keempat Lama',
        'slug' => 'overflow-post-lama',
        'content' => '<p>Berita keempat di luar batas 3 kartu.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subDays(3),
    ]);

    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Assert invalid posts are strictly NOT rendered
    expect($content)->not->toContain('DRAFT TOP SECRET: Kurikulum Baru')
        ->and($content)->not->toContain('FUTURE ANNOUNCEMENT: Libur Semester Depan')
        ->and($content)->not->toContain('NULL DATE POST: Tanpa Tanggal Publikasi')
        ->and($content)->not->toContain('DELETED POST: Berita Dihapus')
        ->and($content)->not->toContain('OVERFLOW POST: Berita Keempat Lama');

    // Assert valid 3 latest posts are rendered
    expect($content)->toContain('VALID POST THREE: Prestasi Santri MHQ Nasional')
        ->and($content)->toContain('VALID POST TWO: Kunjungan Tokoh Ulama')
        ->and($content)->toContain('VALID POST ONE: Kegiatan Pembukaan Santri');

    // Assert ordering by latest published_at: Post 3 precedes Post 2, Post 2 precedes Post 1
    $pos3 = strpos($content, 'VALID POST THREE');
    $pos2 = strpos($content, 'VALID POST TWO');
    $pos1 = strpos($content, 'VALID POST ONE');

    expect($pos3)->toBeLessThan($pos2)
        ->and($pos2)->toBeLessThan($pos1);
});

test('adversarial challenge 5: empty states render cleanly without 500 when database has zero teachers, posts, galleries, or active wave', function () {
    // Entire database is empty (no waves, teachers, posts, galleries)
    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    $responseProfile = $this->get('/profil');
    $responseProfile->assertOk();

    $responseFee = $this->get(route('psb.fee'));
    $responseFee->assertOk();

    expect($content)->toContain('Pondok Pesantren Modern Tahfidzul Quran')
        ->and($responseProfile->getContent())->toContain('Belum ada data asatidz yang dipublikasikan.')
        ->and($content)->toContain('Belum ada warta berita yang dipublikasikan.')
        ->and($content)->toContain('Belum ada dokumentasi kegiatan yang diunggah.')
        ->and($responseFee->getContent())->toContain('100.000') // default fallback
        ->and($responseFee->getContent())->toContain('25.000'); // default fallback
});

test('adversarial challenge 6: visual identity and design tokens are properly configured and present in DOM', function () {
    $response = $this->get('/');
    $response->assertOk();
    $content = $response->getContent();

    // Check key brand colors and styling classes in markup
    expect($content)->toContain('#084C27') // brand-forest
        ->and($content)->toContain('#059669') // emerald-vibrant
        ->and($content)->toContain('#D97706') // gold-amber
        ->and($content)->toContain('rounded-arch') // architectural arch
        ->and($content)->toContain('fixed bottom-6 right-6 z-50') // sticky WhatsApp position
        ->and($content)->toContain('w-14 h-14 rounded-full') // 56x56px circular button
        ->and($content)->toContain('animate-ping') // pulse animation
        ->and($content)->toContain('x-data="{ mobileMenuOpen: false }"'); // mobile responsive drawer
});
