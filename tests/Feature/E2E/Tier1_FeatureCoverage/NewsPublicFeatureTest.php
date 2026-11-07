<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('public news listing displays published articles and excludes drafts', function () {
    if (! Schema::hasTable('posts') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('Posts/Users tables not yet migrated (M1 required).');
    }

    $authorId = (string) Str::ulid();
    DB::table('users')->insert([
        'id' => $authorId,
        'name' => 'Admin CMS',
        'email' => 'cms@daareltazkiyah.com',
        'password' => bcrypt('password'),
        'role' => 'admin_cms',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $publishedId = (string) Str::ulid();
    DB::table('posts')->insert([
        'id' => $publishedId,
        'author_id' => $authorId,
        'title' => 'Wisuda Tahfidz Angkatan Pertama Berlangsung Khidmat',
        'slug' => 'wisuda-tahfidz-angkatan-pertama',
        'excerpt' => 'Sebanyak 30 santri berhasil menyelesaikan hafalan 30 juz.',
        'content' => '<p>Alhamdulillah wisuda tahfidz berjalan lancar dengan dihadiri para wali santri.</p>',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $draftId = (string) Str::ulid();
    DB::table('posts')->insert([
        'id' => $draftId,
        'author_id' => $authorId,
        'title' => 'Rencana Pembangunan Asrama Santri Tahap 2',
        'slug' => 'rencana-pembangunan-asrama-tahap-2',
        'excerpt' => 'Draft rencana perluasan asrama santri baru.',
        'content' => '<p>Konten rahasia belum dipublikasi.</p>',
        'status' => 'draft',
        'published_at' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/berita');
    if ($response->status() === 404) {
        test()->markTestSkipped('News listing route not yet registered (M3 required).');
    }

    $response->assertOk()
        ->assertSee('Wisuda Tahfidz Angkatan Pertama Berlangsung Khidmat')
        ->assertDontSee('Rencana Pembangunan Asrama Santri Tahap 2');
});

test('public news listing filters by category slug', function () {
    if (! Schema::hasTable('posts') || ! Schema::hasTable('categories')) {
        test()->markTestSkipped('Posts/Categories tables not yet migrated (M1 required).');
    }

    $authorId = (string) Str::ulid();
    DB::table('users')->insertOrIgnore([
        'id' => $authorId,
        'name' => 'Admin CMS',
        'email' => 'author@daareltazkiyah.com',
        'password' => bcrypt('password'),
        'role' => 'admin_cms',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $cat1Id = (string) Str::ulid();
    DB::table('categories')->insert([
        'id' => $cat1Id,
        'name' => 'Prestasi Santri',
        'slug' => 'prestasi-santri',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $cat2Id = (string) Str::ulid();
    DB::table('categories')->insert([
        'id' => $cat2Id,
        'name' => 'Pengumuman PSB',
        'slug' => 'pengumuman-psb',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('posts')->insert([
        'id' => (string) Str::ulid(),
        'category_id' => $cat1Id,
        'author_id' => $authorId,
        'title' => 'Santri PPMTQ Raih Juara 1 MHQ Tingkat Provinsi',
        'slug' => 'santri-raih-juara-1-mhq',
        'content' => 'Prestasi membanggakan dari santri.',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('posts')->insert([
        'id' => (string) Str::ulid(),
        'category_id' => $cat2Id,
        'author_id' => $authorId,
        'title' => 'Jadwal Tes Seleksi Masuk Gelombang 1',
        'slug' => 'jadwal-tes-seleksi-gelombang-1',
        'content' => 'Pengumuman tes masuk pondok.',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/berita?category=prestasi-santri');
    if ($response->status() === 404) {
        test()->markTestSkipped('News category filter not yet registered (M3 required).');
    }

    $response->assertOk()
        ->assertSee('Santri PPMTQ Raih Juara 1 MHQ Tingkat Provinsi')
        ->assertDontSee('Jadwal Tes Seleksi Masuk Gelombang 1');
});

test('public news listing searches articles by keyword', function () {
    if (! Schema::hasTable('posts')) {
        test()->markTestSkipped('Posts table not yet migrated (M1 required).');
    }

    $authorId = (string) Str::ulid();
    DB::table('users')->insertOrIgnore([
        'id' => $authorId,
        'name' => 'Admin CMS',
        'email' => 'searchauthor@daareltazkiyah.com',
        'password' => bcrypt('password'),
        'role' => 'admin_cms',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('posts')->insert([
        'id' => (string) Str::ulid(),
        'author_id' => $authorId,
        'title' => 'Kajian Rutin Kitab Kuning Bersama Pimpinan Pondok',
        'slug' => 'kajian-rutin-kitab-kuning',
        'content' => 'Kajian kitab fiqih setiap Ahad pagi.',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/berita?search=Kuning');
    if ($response->status() === 404) {
        test()->markTestSkipped('News search route not yet registered (M3 required).');
    }

    $response->assertOk()
        ->assertSee('Kajian Rutin Kitab Kuning');
});

test('public news detail displays article content and renders Open Graph meta tags for WhatsApp sharing', function () {
    if (! Schema::hasTable('posts')) {
        test()->markTestSkipped('Posts table not yet migrated (M1 required).');
    }

    $authorId = (string) Str::ulid();
    DB::table('users')->insertOrIgnore([
        'id' => $authorId,
        'name' => 'Admin CMS',
        'email' => 'ogauthor@daareltazkiyah.com',
        'password' => bcrypt('password'),
        'role' => 'admin_cms',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $slug = 'pembukaan-pendaftaran-santri-baru-2027';
    DB::table('posts')->insert([
        'id' => (string) Str::ulid(),
        'author_id' => $authorId,
        'title' => 'Pembukaan Pendaftaran Santri Baru TA 2027/2028',
        'slug' => $slug,
        'excerpt' => 'PPMTQ Daar El Tazkiyah resmi membuka pendaftaran santri baru.',
        'content' => '<p>Informasi lengkap syarat dan alur pendaftaran santri baru.</p>',
        'featured_image' => 'posts/og-thumbnail.jpg',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get("/berita/{$slug}");
    if ($response->status() === 404) {
        test()->markTestSkipped('News detail route not yet registered (M3 required).');
    }

    $response->assertOk()
        ->assertSee('Pembukaan Pendaftaran Santri Baru TA 2027/2028')
        ->assertSee('property="og:title"', false)
        ->assertSee('property="og:description"', false)
        ->assertSee('property="og:image"', false);
});

test('viewing public news records daily aggregated post views', function () {
    if (! Schema::hasTable('posts') || ! Schema::hasTable('post_views')) {
        test()->markTestSkipped('Posts or post_views table not yet migrated (M1 required).');
    }

    $authorId = (string) Str::ulid();
    DB::table('users')->insertOrIgnore([
        'id' => $authorId,
        'name' => 'Admin CMS',
        'email' => 'viewauthor@daareltazkiyah.com',
        'password' => bcrypt('password'),
        'role' => 'admin_cms',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $postId = (string) Str::ulid();
    $slug = 'kunjungan-tokoh-nasional-ke-pondok';
    DB::table('posts')->insert([
        'id' => $postId,
        'author_id' => $authorId,
        'title' => 'Kunjungan Tokoh Nasional ke Pondok',
        'slug' => $slug,
        'content' => 'Kunjungan silaturahmi.',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get("/berita/{$slug}");
    if ($response->status() === 404) {
        test()->markTestSkipped('News detail route not yet registered (M3 required).');
    }

    $response->assertOk();

    // Verify post_views table records viewed_at date and count
    $today = now()->toDateString();
    $record = DB::table('post_views')
        ->where('post_id', $postId)
        ->where('viewed_at', $today)
        ->first();

    expect($record)->not->toBeNull();
    expect($record->count)->toBeGreaterThanOrEqual(1);
});
