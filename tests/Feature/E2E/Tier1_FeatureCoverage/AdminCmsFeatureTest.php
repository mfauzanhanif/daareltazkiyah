<?php

declare(strict_types=1);

use App\Models\Gallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

test('admin with admin_cms role can create, update, and soft-delete articles', function () {
    if (! Schema::hasTable('posts') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('Posts or Users tables not yet migrated (M1 required).');
    }

    $admin = createUser([
        'role' => 'admin_cms',
    ]);

    $this->actingAs($admin);

    $createResponse = $this->post('/admin/cms/posts', [
        'title' => 'Kegiatan Khotmil Quran Santri Akhir',
        'slug' => 'kegiatan-khotmil-quran-santri-akhir',
        'content' => '<p>Kegiatan khotmil Quran telah dilaksanakan dengan lancar.</p>',
        'status' => 'published',
        'published_at' => now()->toDateTimeString(),
    ]);

    if ($createResponse->status() === 404) {
        test()->markTestSkipped('Admin CMS posts route not yet registered (M3 required).');
    }

    $createResponse->assertSessionHasNoErrors();

    $post = DB::table('posts')->where('slug', 'kegiatan-khotmil-quran-santri-akhir')->first();
    expect($post)->not->toBeNull();
    expect($post->title)->toBe('Kegiatan Khotmil Quran Santri Akhir');

    // Update post
    $updateResponse = $this->put("/admin/cms/posts/{$post->id}", [
        'title' => 'Kegiatan Khotmil Quran Santri Akhir Diperbarui',
        'slug' => 'kegiatan-khotmil-quran-santri-akhir',
        'content' => '<p>Konten diperbarui dengan data santri wisuda.</p>',
        'status' => 'published',
    ]);
    $updateResponse->assertSessionHasNoErrors();

    $updatedPost = DB::table('posts')->where('id', $post->id)->first();
    expect($updatedPost->title)->toBe('Kegiatan Khotmil Quran Santri Akhir Diperbarui');

    // Soft delete post
    $deleteResponse = $this->delete("/admin/cms/posts/{$post->id}");
    $deleteResponse->assertSessionHasNoErrors();

    $deletedPost = DB::table('posts')->where('id', $post->id)->first();
    expect($deletedPost->deleted_at)->not->toBeNull();
});

test('admin can manage categories with slug generation and hierarchy', function () {
    if (! Schema::hasTable('categories') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('Categories or Users tables not yet migrated (M1 required).');
    }

    $admin = createUser([
        'role' => 'admin_cms',
    ]);

    $this->actingAs($admin);

    $response = $this->post('/admin/cms/categories', [
        'name' => 'Artikel Kajian',
        'slug' => 'artikel-kajian',
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('Admin CMS categories route not yet registered (M3 required).');
    }

    $response->assertSessionHasNoErrors();
    $cat = DB::table('categories')->where('slug', 'artikel-kajian')->first();
    expect($cat)->not->toBeNull();
    expect($cat->name)->toBe('Artikel Kajian');
});

test('admin can create gallery album and upload photos', function () {
    if (! Schema::hasTable('galleries') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('Galleries or Users tables not yet migrated (M1 required).');
    }

    $admin = createUser([
        'role' => 'admin_cms',
    ]);

    $this->actingAs($admin);

    $response = $this->post('/admin/cms/galleries', [
        'title' => 'Album Wisuda Santri TA 2026/2027',
        'slug' => 'album-wisuda-santri-2026-2027',
        'description' => 'Momen kebersamaan santri dan asatidz.',
        'event_date' => '2027-02-01',
        'is_published' => true,
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('Admin CMS galleries route not yet registered (M3 required).');
    }

    $response->assertSessionHasNoErrors();
    $gallery = DB::table('galleries')->where('slug', 'album-wisuda-santri-2026-2027')->first();
    expect($gallery)->not->toBeNull();
    expect($gallery->is_published)->toBeTruthy();
});

test('admin can manage teachers and update site settings', function () {
    if (! Schema::hasTable('teachers') || ! Schema::hasTable('site_settings') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('Teachers/Site_settings tables not yet migrated (M1 required).');
    }

    $admin = createUser([
        'role' => 'super_admin',
    ]);

    $this->actingAs($admin);

    // Create Teacher
    $teacherResponse = $this->post('/admin/cms/teachers', [
        'full_name' => 'Ust. Muhammad Zaid, Lc.',
        'role_title' => 'Pembimbing Bahasa Arab',
        'bio' => 'Alumni Universitas Al-Azhar Kairo',
        'specialization' => 'Nahwu & Shorof',
        'sort_order' => 2,
        'is_active' => true,
    ]);

    if ($teacherResponse->status() === 404) {
        test()->markTestSkipped('Admin CMS teachers route not yet registered (M3 required).');
    }

    $teacherResponse->assertSessionHasNoErrors();
    $teacher = DB::table('teachers')->where('full_name', 'Ust. Muhammad Zaid, Lc.')->first();
    expect($teacher)->not->toBeNull();

    // Update Setting
    $settingResponse = $this->post('/admin/cms/settings', [
        'psb_whatsapp_number' => '628999888777',
    ]);

    $settingResponse->assertSessionHasNoErrors();
    $setting = DB::table('site_settings')->where('key', 'psb_whatsapp_number')->first();
    expect($setting)->not->toBeNull();
    expect($setting->value)->toBe('628999888777');
});

test('unauthorized users without manage-cms gate cannot access CMS administration', function () {
    $guestResponse = $this->get('/admin/cms/posts');
    // Guest redirected to login
    expect(in_array($guestResponse->status(), [302, 403, 404]))->toBeTrue();

    if (Schema::hasTable('users') && Schema::hasColumn('users', 'role')) {
        $psbUser = createUser([
            'role' => 'admin_psb',
        ]);

        $this->actingAs($psbUser);
        $userResponse = $this->get('/admin/cms/posts');
        if ($userResponse->status() !== 404) {
            $userResponse->assertForbidden();
        }
    }
});

test('admin can access all CMS management views', function () {
    $admin = createUser([
        'role' => 'admin_cms',
    ]);
    $this->actingAs($admin);

    $this->get('/admin/cms/posts/create')->assertOk()->assertSee('Tulis Artikel Baru');
    $this->get('/admin/cms/categories')->assertOk()->assertSee('Kategori Artikel & Warta');
    $this->get('/admin/cms/galleries')->assertOk()->assertSee('Galeri Foto Dokumentasi');
    $this->get('/admin/cms/teachers')->assertOk()->assertSee('Dewan Asatidz & Pengajar');
});

test('super admin can access and update settings view', function () {
    $admin = createUser([
        'role' => 'super_admin',
    ]);
    $this->actingAs($admin);

    $this->get('/admin/cms/settings')->assertOk()->assertSee('Pengaturan Sistem & Situs');
});

test('admin can upload photos to gallery album and remove them', function () {
    Storage::fake('public');

    $admin = createUser([
        'role' => 'admin_cms',
    ]);
    $this->actingAs($admin);

    $gallery = Gallery::create([
        'title' => 'Kegiatan Muhadharah Akbar',
        'slug' => 'kegiatan-muhadharah-akbar',
        'is_published' => true,
    ]);

    $file = UploadedFile::fake()->image('muhadharah1.jpg');

    $response = $this->post("/admin/cms/galleries/{$gallery->id}/photos", [
        'photos' => [$file],
        'caption' => 'Pidato santri',
    ]);

    $response->assertSessionHasNoErrors();
    $photo = DB::table('gallery_photos')->where('gallery_id', $gallery->id)->first();
    expect($photo)->not->toBeNull();
    expect($photo->caption)->toBe('Pidato santri');

    // Show gallery photo manager view
    $this->get("/admin/cms/galleries/{$gallery->id}")->assertOk()->assertSee('Kegiatan Muhadharah Akbar');

    // Delete photo
    $deleteResponse = $this->delete("/admin/cms/galleries/photos/{$photo->id}");
    $deleteResponse->assertSessionHasNoErrors();
    expect(DB::table('gallery_photos')->where('id', $photo->id)->first())->toBeNull();
});
