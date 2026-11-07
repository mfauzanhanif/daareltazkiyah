<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\PostStatus;
use App\Enums\UserRole;
use App\Livewire\Public\NewsList;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('empirical challenge 1: Livewire search reactivity, debouncing attribute, and multi-field matching (title, excerpt, content)', function () {
    $author = createUser(['role' => UserRole::AdminCms]);
    $category = Category::create([
        'name' => 'Warta Utama',
        'slug' => 'warta-utama',
    ]);

    // 1. Post matching title only
    $postA = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Musabaqah Tahfidz Quran Tingkat Nasional 2027',
        'slug' => 'musabaqah-tahfidz-quran-nasional',
        'excerpt' => 'Lomba hafalan Al-Quran santri pondok.',
        'content' => '<p>Santri berpartisipasi dalam ajang bergengsi.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
    ]);

    // 2. Post matching excerpt only
    $postB = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Kunjungan Silaturahmi Pengurus Ormas Islam',
        'slug' => 'kunjungan-silaturahmi-ormas',
        'excerpt' => 'Seluruh asatidz dan dewan pembina menyambut di ruang auditorium utama.',
        'content' => '<p>Acara berlangsung dengan ramah tamah dan makan siang bersama.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
    ]);

    // 3. Post matching content only
    $postC = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Kajian Ba\'da Subuh Kitab Kuning',
        'slug' => 'kajian-bada-subuh-kitab-kuning',
        'excerpt' => 'Rutinitas subuh santri mukim.',
        'content' => '<p>Pengasuh memberikan pemaparan mendalam tentang konsep tadabbur alam semesta.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
    ]);

    // 4. Unrelated control post
    $postD = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Jadwal Ujian Semester Genap',
        'slug' => 'jadwal-ujian-semester-genap',
        'excerpt' => 'Informasi penting untuk santri dan wali.',
        'content' => '<p>Diharapkan santri belajar dengan tekun.</p>',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
    ]);

    // Assert debouncing attribute is rendered in template
    Livewire::test(NewsList::class)
        ->assertSeeHtml('wire:model.live.debounce.300ms="search"')
        // Search by title keyword
        ->set('search', 'Musabaqah')
        ->assertSee('Musabaqah Tahfidz Quran Tingkat Nasional 2027')
        ->assertDontSee('Kunjungan Silaturahmi Pengurus Ormas Islam')
        ->assertDontSee('Kajian Ba\'da Subuh Kitab Kuning')
        ->assertDontSee('Jadwal Ujian Semester Genap')
        // Search by excerpt keyword
        ->set('search', 'auditorium')
        ->assertSee('Kunjungan Silaturahmi Pengurus Ormas Islam')
        ->assertDontSee('Musabaqah Tahfidz Quran Tingkat Nasional 2027')
        ->assertDontSee('Kajian Ba\'da Subuh Kitab Kuning')
        // Search by content keyword
        ->set('search', 'tadabbur')
        ->assertSee('Kajian Ba\'da Subuh Kitab Kuning')
        ->assertDontSee('Musabaqah Tahfidz Quran Tingkat Nasional 2027')
        ->assertDontSee('Kunjungan Silaturahmi Pengurus Ormas Islam')
        // Search non-existent keyword -> triggers empty state with reset button
        ->set('search', 'KeywordGhoibYangTidakAda999')
        ->assertSee('Tidak Ada Artikel Ditemukan')
        ->assertSee('Reset')
        // Click resetFilters -> all 4 posts return
        ->call('resetFilters')
        ->assertSee('Musabaqah Tahfidz Quran Tingkat Nasional 2027')
        ->assertSee('Kunjungan Silaturahmi Pengurus Ormas Islam')
        ->assertSee('Kajian Ba\'da Subuh Kitab Kuning')
        ->assertSee('Jadwal Ujian Semester Genap');

    // Adversarial SQL injection attempt in search query
    Livewire::test(NewsList::class)
        ->set('search', "' OR '1'='1' -- ")
        ->assertOk()
        ->assertSee('Tidak Ada Artikel Ditemukan');
});

test('empirical challenge 2: Category filter switching, toggling off, and draft/scheduled count isolation', function () {
    $author = createUser(['role' => UserRole::AdminCms]);

    $catWarta = Category::create(['name' => 'Warta Pondok', 'slug' => 'warta-pondok']);
    $catPrestasi = Category::create(['name' => 'Prestasi Santri', 'slug' => 'prestasi-santri']);

    // Category Warta: 2 published, 1 draft, 1 scheduled
    Post::create([
        'category_id' => $catWarta->id,
        'author_id' => $author->id,
        'title' => 'Warta Published 1',
        'slug' => 'warta-published-1',
        'content' => 'Konten warta 1',
        'status' => PostStatus::Published,
        'published_at' => now()->subHours(2),
    ]);

    Post::create([
        'category_id' => $catWarta->id,
        'author_id' => $author->id,
        'title' => 'Warta Published 2',
        'slug' => 'warta-published-2',
        'content' => 'Konten warta 2',
        'status' => PostStatus::Published,
        'published_at' => now()->subHours(1),
    ]);

    Post::create([
        'category_id' => $catWarta->id,
        'author_id' => $author->id,
        'title' => 'Warta DRAFT Secret',
        'slug' => 'warta-draft-secret',
        'content' => 'Draft tidak boleh dihitung',
        'status' => PostStatus::Draft,
        'published_at' => null,
    ]);

    Post::create([
        'category_id' => $catWarta->id,
        'author_id' => $author->id,
        'title' => 'Warta SCHEDULED Future',
        'slug' => 'warta-scheduled-future',
        'content' => 'Scheduled tidak boleh dihitung',
        'status' => PostStatus::Scheduled,
        'published_at' => now()->addDays(3),
    ]);

    // Category Prestasi: 1 published
    Post::create([
        'category_id' => $catPrestasi->id,
        'author_id' => $author->id,
        'title' => 'Prestasi Published 1',
        'slug' => 'prestasi-published-1',
        'content' => 'Konten prestasi 1',
        'status' => PostStatus::Published,
        'published_at' => now()->subHour(),
    ]);

    $lw = Livewire::test(NewsList::class);

    // Assert category counts strictly isolate published posts (Warta = 2, Prestasi = 1)
    $lw->assertSee('Warta Pondok (2)')
        ->assertDontSee('Warta Pondok (4)')
        ->assertDontSee('Warta Pondok (3)')
        ->assertSee('Prestasi Santri (1)');

    // 1. Switch to Warta
    $lw->call('setCategory', 'warta-pondok')
        ->assertSee('Warta Published 1')
        ->assertSee('Warta Published 2')
        ->assertDontSee('Prestasi Published 1')
        ->assertDontSee('Warta DRAFT Secret')
        ->assertDontSee('Warta SCHEDULED Future');

    // 2. Click Warta again -> Toggles OFF back to all
    $lw->call('setCategory', 'warta-pondok')
        ->assertSee('Warta Published 1')
        ->assertSee('Warta Published 2')
        ->assertSee('Prestasi Published 1');

    // 3. Switch to Prestasi
    $lw->call('setCategory', 'prestasi-santri')
        ->assertSee('Prestasi Published 1')
        ->assertDontSee('Warta Published 1')
        ->assertDontSee('Warta Published 2');

    // 4. Reset via setCategory('')
    $lw->call('setCategory', '')
        ->assertSee('Warta Published 1')
        ->assertSee('Warta Published 2')
        ->assertSee('Prestasi Published 1');
});

test('empirical challenge 3: News pagination beyond 9 items and page reset on search or category filter change', function () {
    $author = createUser(['role' => UserRole::AdminCms]);
    $categoryA = Category::create(['name' => 'Kategori Alpha', 'slug' => 'kategori-alpha']);
    $categoryB = Category::create(['name' => 'Kategori Beta', 'slug' => 'kategori-beta']);

    // Seed 19 posts in Category A
    for ($i = 1; $i <= 19; $i++) {
        $num = str_pad((string) $i, 2, '0', STR_PAD_LEFT);
        Post::create([
            'category_id' => $categoryA->id,
            'author_id' => $author->id,
            'title' => "Artikel Alpha {$num}",
            'slug' => "artikel-alpha-{$num}",
            'content' => "Konten artikel alpha nomor {$num}",
            'status' => PostStatus::Published,
            'published_at' => now()->subMinutes(100 - $i), // higher i has later published_at
        ]);
    }

    // Seed 1 post in Category B
    Post::create([
        'category_id' => $categoryB->id,
        'author_id' => $author->id,
        'title' => 'Artikel Tunggal Beta',
        'slug' => 'artikel-tunggal-beta',
        'content' => 'Hanya ada 1 artikel di kategori beta',
        'status' => PostStatus::Published,
        'published_at' => now()->subMinute(),
    ]);

    // Total posts = 20. With 9 per page: Page 1 = 9, Page 2 = 9, Page 3 = 2.
    $lw = Livewire::test(NewsList::class);

    // Page 1: Check newest items appear, oldest do not
    $lw->assertSee('Artikel Tunggal Beta') // newest
        ->assertSee('Artikel Alpha 19')
        ->assertSee('Artikel Alpha 18')
        ->assertDontSee('Artikel Alpha 10')
        ->assertDontSee('Artikel Alpha 01');

    // Navigate to Page 2
    $lw->call('gotoPage', 2)
        ->assertSee('Artikel Alpha 11')
        ->assertSee('Artikel Alpha 03')
        ->assertDontSee('Artikel Tunggal Beta')
        ->assertDontSee('Artikel Alpha 19')
        ->assertDontSee('Artikel Alpha 02');

    // Navigate to Page 3
    $lw->call('gotoPage', 3)
        ->assertSee('Artikel Alpha 02')
        ->assertSee('Artikel Alpha 01')
        ->assertDontSee('Artikel Alpha 19');

    // Boundary Stress Test: User is on Page 3, now clicks Category Beta (which has only 1 post).
    // If page is NOT reset, user would be stuck on page 3 of Category Beta (showing empty state).
    $lw->call('setCategory', 'kategori-beta')
        ->assertSee('Artikel Tunggal Beta')
        ->assertDontSee('Artikel Alpha 01')
        ->assertDontSee('Tidak Ada Artikel Ditemukan');

    // Boundary Stress Test 2: User clears category, goes to Page 2, then searches for "Artikel Alpha 19".
    // If page is NOT reset on search, page 2 of search results would be empty.
    $lw->call('setCategory', '')
        ->call('gotoPage', 2)
        ->set('search', 'Artikel Alpha 19')
        ->assertSee('Artikel Alpha 19')
        ->assertDontSee('Tidak Ada Artikel Ditemukan');
});

test('empirical challenge 4: Strict exclusion of drafts, future scheduled posts, null published_at, and soft-deleted articles across search and categories', function () {
    $author = createUser(['role' => UserRole::AdminCms]);
    $cat = Category::create(['name' => 'Warta Berita', 'slug' => 'warta-berita']);

    // 1. Draft post
    $draft = Post::create([
        'category_id' => $cat->id,
        'author_id' => $author->id,
        'title' => 'Kabar Rahasia Pondok DRAFT',
        'slug' => 'kabar-rahasia-pondok-draft',
        'content' => 'Konten rahasia kabar pondok.',
        'status' => PostStatus::Draft,
        'published_at' => null,
    ]);

    // 2. Future scheduled post
    $scheduled = Post::create([
        'category_id' => $cat->id,
        'author_id' => $author->id,
        'title' => 'Pengumuman Jadwal Masa Depan SCHEDULED',
        'slug' => 'pengumuman-jadwal-masa-depan-scheduled',
        'content' => 'Konten jadwal kabar pondok masa depan.',
        'status' => PostStatus::Published,
        'published_at' => now()->addDays(5),
    ]);

    // 3. Published but null published_at
    $nullDate = Post::create([
        'category_id' => $cat->id,
        'author_id' => $author->id,
        'title' => 'Berita Rusak Tanpa Tanggal NULLDATE',
        'slug' => 'berita-rusak-tanpa-tanggal-nulldate',
        'content' => 'Konten kabar pondok tanpa tanggal.',
        'status' => PostStatus::Published,
        'published_at' => null,
    ]);

    // 4. Soft-deleted published post
    $deleted = Post::create([
        'category_id' => $cat->id,
        'author_id' => $author->id,
        'title' => 'Berita Terhapus Dari Sistem DELETED',
        'slug' => 'berita-terhapus-dari-sistem-deleted',
        'content' => 'Konten kabar pondok yang telah dihapus.',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
    ]);
    $deleted->delete();

    // 5. Valid published post
    $valid = Post::create([
        'category_id' => $cat->id,
        'author_id' => $author->id,
        'title' => 'Berita Resmi Publikasi VALID',
        'slug' => 'berita-resmi-publikasi-valid',
        'content' => 'Konten resmi kabar pondok untuk umum.',
        'status' => PostStatus::Published,
        'published_at' => now()->subHours(3),
    ]);

    // Test in Livewire reactive search: searching common word "kabar pondok"
    Livewire::test(NewsList::class)
        ->set('search', 'kabar pondok')
        ->assertSee('Berita Resmi Publikasi VALID')
        ->assertDontSee('Kabar Rahasia Pondok DRAFT')
        ->assertDontSee('Pengumuman Jadwal Masa Depan SCHEDULED')
        ->assertDontSee('Berita Rusak Tanpa Tanggal NULLDATE')
        ->assertDontSee('Berita Terhapus Dari Sistem DELETED');

    // Test in HTTP GET /berita route
    $response = $this->get('/berita?search=kabar+pondok');
    $response->assertOk()
        ->assertSee('Berita Resmi Publikasi VALID')
        ->assertDontSee('Kabar Rahasia Pondok DRAFT')
        ->assertDontSee('Pengumuman Jadwal Masa Depan SCHEDULED')
        ->assertDontSee('Berita Rusak Tanpa Tanggal NULLDATE')
        ->assertDontSee('Berita Terhapus Dari Sistem DELETED');

    // Test detail route /berita/{slug}: Valid post returns 200, all invalid posts return 404
    $this->get("/berita/{$valid->slug}")->assertOk();
    $this->get("/berita/{$draft->slug}")->assertNotFound();
    $this->get("/berita/{$scheduled->slug}")->assertNotFound();
    $this->get("/berita/{$nullDate->slug}")->assertNotFound();
    $this->get("/berita/{$deleted->slug}")->assertNotFound();
});

test('empirical challenge 5: Read time estimation boundary testing and rich text HTML stripping', function () {
    $author = createUser();

    // Helper to generate word-counted text
    $generateWords = fn (int $count): string => implode(' ', array_fill(0, $count, 'kata'));

    // Case 1: Empty content -> 1 minute minimum
    $post0 = new Post(['content' => '']);
    expect($post0->estimatedReadTime())->toBe(1);

    // Case 2: Pure HTML markup without text -> 1 minute minimum
    $postHtml = new Post(['content' => '<p><br><span class="test"><strong><em></em></strong></span></p>']);
    expect($postHtml->estimatedReadTime())->toBe(1);

    // Case 3: 50 words -> 1 minute
    $post50 = new Post(['content' => $generateWords(50)]);
    expect($post50->estimatedReadTime())->toBe(1);

    // Case 4: Exactly 200 words -> 1 minute (200 / 200 = 1.0)
    $post200 = new Post(['content' => $generateWords(200)]);
    expect($post200->estimatedReadTime())->toBe(1);

    // Case 5: 201 words -> 2 minutes (ceil(201 / 200) = 2)
    $post201 = new Post(['content' => $generateWords(201)]);
    expect($post201->estimatedReadTime())->toBe(2);

    // Case 6: Exactly 400 words -> 2 minutes
    $post400 = new Post(['content' => $generateWords(400)]);
    expect($post400->estimatedReadTime())->toBe(2);

    // Case 7: 401 words -> 3 minutes
    $post401 = new Post(['content' => $generateWords(401)]);
    expect($post401->estimatedReadTime())->toBe(3);

    // Case 8: 1000 words wrapped in HTML paragraphs -> 5 minutes
    $wordsArray = explode(' ', $generateWords(1000));
    $paragraphs = array_map(fn (array $chunk): string => implode(' ', $chunk), array_chunk($wordsArray, 100));
    $htmlContent = '<div><p>'.implode('</p><p>', $paragraphs).'</p></div>';
    $post1000 = new Post(['content' => $htmlContent]);
    expect($post1000->estimatedReadTime())->toBe(5);

    // Verify detail page displays the calculated read time badge
    $persistedPost = Post::create([
        'author_id' => $author->id,
        'title' => 'Artikel Uji Waktu Baca',
        'slug' => 'artikel-uji-waktu-baca',
        'content' => $generateWords(450), // 450 words -> 3 minutes
        'status' => PostStatus::Published,
        'published_at' => now()->subHour(),
    ]);

    $response = $this->get("/berita/{$persistedPost->slug}");
    $response->assertOk()
        ->assertSee('3 menit baca');
});

test('empirical challenge 6: Gallery lightbox multi-photo indexing, thumbnail bindings, and wrap-around navigation', function () {
    $gallery = Gallery::create([
        'title' => 'Rihlah Santri 2027',
        'slug' => 'rihlah-santri-2027',
        'description' => 'Dokumentasi rihlah.',
        'cover_image' => 'galleries/cover.webp',
        'event_date' => '2027-02-10',
        'sort_order' => 1,
        'is_published' => true,
    ]);

    // Add 4 photos to gallery
    for ($i = 1; $i <= 4; $i++) {
        GalleryPhoto::create([
            'gallery_id' => $gallery->id,
            'file_path' => "galleries/photo-{$i}.webp",
            'caption' => "Foto dokumentasi kegiatan nomor {$i}",
            'sort_order' => $i,
        ]);
    }

    $response = $this->get('/galeri');
    $response->assertOk();
    $content = $response->getContent();

    // 1. Photo count badge in album card
    expect($content)->toContain('4 Foto');

    // 2. Cover image triggers openLightbox at index 0
    expect($content)->toMatch('/@click="openLightbox\(JSON\.parse\(.*?\), 0\)"/');

    // 3. Mini thumbnails render with indices 0, 1, 2, 3
    for ($idx = 0; $idx < 4; $idx++) {
        expect($content)->toMatch('/@click="openLightbox\(JSON\.parse\(.*?\), '.$idx.'\)"/');
    }

    // 4. Wrap-around navigation algorithms in Alpine x-data
    // Next algorithm: (currentIndex + 1) % photos.length
    expect($content)->toContain('this.currentIndex = (this.currentIndex + 1) % this.photos.length;');
    // Prev algorithm: (currentIndex - 1 + photos.length) % photos.length
    expect($content)->toContain('this.currentIndex = (this.currentIndex - 1 + this.photos.length) % this.photos.length;');

    // 5. Lightbox counter element
    expect($content)->toContain('Foto <span x-text="currentIndex + 1"></span> dari <span x-text="photos.length"></span>');

    // 6. Navigation buttons are conditionally shown when photos.length > 1
    expect($content)->toContain('x-show="photos.length > 1"');
});

test('empirical challenge 7: Gallery lightbox keyboard navigation, touch gesture bindings, and accessibility tokens', function () {
    Gallery::create([
        'title' => 'Haflah Akhirussanah 2027',
        'slug' => 'haflah-akhirussanah-2027',
        'cover_image' => 'galleries/haflah.webp',
        'event_date' => '2027-05-15',
        'sort_order' => 1,
        'is_published' => true,
    ]);

    $response = $this->get('/galeri');
    $response->assertOk();
    $content = $response->getContent();

    // 1. Keyboard Window Event Listeners
    expect($content)->toContain('@keydown.escape.window="closeLightbox()"')
        ->and($content)->toContain('@keydown.arrow-right.window="if (isOpen) next()"')
        ->and($content)->toContain('@keydown.arrow-left.window="if (isOpen) prev()"');

    // 2. Touch gesture listeners for mobile swipe
    expect($content)->toContain('@touchstart="handleTouchStart($event)"')
        ->and($content)->toContain('@touchend="handleTouchEnd($event)"');

    // 3. Accessibility attributes
    expect($content)->toContain('role="dialog"')
        ->and($content)->toContain('aria-modal="true"')
        ->and($content)->toContain('aria-label="Penampil Foto Galeri"');

    // 4. Visual design tokens: frosted glass backdrop
    expect($content)->toContain('backdrop-blur-md')
        ->and($content)->toContain('bg-black/85');
});

test('empirical challenge 8: Gallery empty state compliance and gallery pagination beyond 12 albums', function () {
    // Phase 1: Database has zero galleries -> DESIGN §12.2 compliant empty state
    $responseEmpty = $this->get('/galeri');
    $responseEmpty->assertOk();
    $contentEmpty = $responseEmpty->getContent();

    expect($contentEmpty)->toContain('Belum ada album galeri.')
        ->and($contentEmpty)->toContain('Dokumentasi kegiatan harian, tahfidz, dan prestasi santri akan segera dipublikasikan di sini.');

    // Phase 2: Seed 15 published galleries and 2 unpublished galleries
    for ($i = 1; $i <= 15; $i++) {
        $pad = str_pad((string) $i, 2, '0', STR_PAD_LEFT);
        Gallery::create([
            'title' => "Album Kegiatan {$pad}",
            'slug' => "album-kegiatan-{$pad}",
            'cover_image' => "galleries/album-{$pad}.webp",
            'event_date' => "2027-01-{$pad}",
            'sort_order' => $i,
            'is_published' => true,
        ]);
    }

    Gallery::create([
        'title' => 'Album Rahasia Internal Unpublished',
        'slug' => 'album-rahasia-internal',
        'cover_image' => 'galleries/secret.webp',
        'sort_order' => 99,
        'is_published' => false,
    ]);

    // Page 1: Has 12 albums (Album 01 to Album 12), excludes Album 13-15 and unpublished
    $responsePage1 = $this->get('/galeri');
    $responsePage1->assertOk();
    $contentPage1 = $responsePage1->getContent();

    expect($contentPage1)->toContain('Album Kegiatan 01')
        ->and($contentPage1)->toContain('Album Kegiatan 12')
        ->and($contentPage1)->not->toContain('Album Kegiatan 13')
        ->and($contentPage1)->not->toContain('Album Kegiatan 15')
        ->and($contentPage1)->not->toContain('Album Rahasia Internal Unpublished');

    // Page 2: Has remaining 3 albums (Album 13 to Album 15)
    $responsePage2 = $this->get('/galeri?page=2');
    $responsePage2->assertOk();
    $contentPage2 = $responsePage2->getContent();

    expect($contentPage2)->toContain('Album Kegiatan 13')
        ->and($contentPage2)->toContain('Album Kegiatan 14')
        ->and($contentPage2)->toContain('Album Kegiatan 15')
        ->and($contentPage2)->not->toContain('Album Kegiatan 01')
        ->and($contentPage2)->not->toContain('Album Rahasia Internal Unpublished');
});
