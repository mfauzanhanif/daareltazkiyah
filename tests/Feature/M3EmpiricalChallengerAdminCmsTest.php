<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\PostStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('adversarial challenge 1: Unauthenticated guests are strictly redirected to login across all 24 CMS routes', function () {
    // Provision placeholder models for route parameters
    $user = User::factory()->create(['role' => UserRole::SuperAdmin]);
    $category = Category::create(['name' => 'Kategori Dummy', 'slug' => 'kategori-dummy']);
    $post = Post::create([
        'author_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Artikel Dummy',
        'slug' => 'artikel-dummy',
        'content' => 'Konten dummy',
        'status' => PostStatus::Published,
    ]);
    $gallery = Gallery::create([
        'title' => 'Galeri Dummy',
        'slug' => 'galeri-dummy',
        'is_published' => true,
    ]);
    $photo = GalleryPhoto::create([
        'gallery_id' => $gallery->id,
        'file_path' => 'galleries/photos/dummy.jpg',
        'sort_order' => 1,
    ]);
    $teacher = Teacher::create([
        'full_name' => 'Ustadz Dummy',
        'role_title' => 'Pengajar Dummy',
    ]);

    $routes = [
        ['GET', '/admin/cms'],
        ['GET', '/admin/cms/posts'],
        ['GET', '/admin/cms/posts/create'],
        ['POST', '/admin/cms/posts'],
        ['GET', "/admin/cms/posts/{$post->id}/edit"],
        ['PUT', "/admin/cms/posts/{$post->id}"],
        ['DELETE', "/admin/cms/posts/{$post->id}"],
        ['GET', '/admin/cms/categories'],
        ['POST', '/admin/cms/categories'],
        ['PUT', "/admin/cms/categories/{$category->id}"],
        ['DELETE', "/admin/cms/categories/{$category->id}"],
        ['GET', '/admin/cms/galleries'],
        ['POST', '/admin/cms/galleries'],
        ['GET', "/admin/cms/galleries/{$gallery->id}"],
        ['PUT', "/admin/cms/galleries/{$gallery->id}"],
        ['DELETE', "/admin/cms/galleries/{$gallery->id}"],
        ['POST', "/admin/cms/galleries/{$gallery->id}/photos"],
        ['DELETE', "/admin/cms/galleries/photos/{$photo->id}"],
        ['GET', '/admin/cms/teachers'],
        ['POST', '/admin/cms/teachers'],
        ['PUT', "/admin/cms/teachers/{$teacher->id}"],
        ['DELETE', "/admin/cms/teachers/{$teacher->id}"],
        ['GET', '/admin/cms/settings'],
        ['POST', '/admin/cms/settings'],
    ];

    foreach ($routes as [$method, $uri]) {
        $response = $this->call($method, $uri);
        expect($response->status())->toBe(302, "Expected 302 redirect for {$method} {$uri}");
        $response->assertRedirect('/login');
    }
});

test('adversarial challenge 2: admin_psb receives 403 Forbidden across all 24 CMS routes', function () {
    $psbAdmin = User::factory()->create(['role' => UserRole::AdminPsb]);
    $this->actingAs($psbAdmin);

    // Provision dummy models
    $superAdmin = User::factory()->create(['role' => UserRole::SuperAdmin]);
    $category = Category::create(['name' => 'Kategori Dummy PSB', 'slug' => 'kategori-dummy-psb']);
    $post = Post::create([
        'author_id' => $superAdmin->id,
        'category_id' => $category->id,
        'title' => 'Artikel Dummy PSB',
        'slug' => 'artikel-dummy-psb',
        'content' => 'Konten dummy PSB',
        'status' => PostStatus::Published,
    ]);
    $gallery = Gallery::create([
        'title' => 'Galeri Dummy PSB',
        'slug' => 'galeri-dummy-psb',
        'is_published' => true,
    ]);
    $photo = GalleryPhoto::create([
        'gallery_id' => $gallery->id,
        'file_path' => 'galleries/photos/dummy.jpg',
        'sort_order' => 1,
    ]);
    $teacher = Teacher::create([
        'full_name' => 'Ustadz Dummy PSB',
        'role_title' => 'Pengajar Dummy',
    ]);

    $routes = [
        ['GET', '/admin/cms'],
        ['GET', '/admin/cms/posts'],
        ['GET', '/admin/cms/posts/create'],
        ['POST', '/admin/cms/posts'],
        ['GET', "/admin/cms/posts/{$post->id}/edit"],
        ['PUT', "/admin/cms/posts/{$post->id}"],
        ['DELETE', "/admin/cms/posts/{$post->id}"],
        ['GET', '/admin/cms/categories'],
        ['POST', '/admin/cms/categories'],
        ['PUT', "/admin/cms/categories/{$category->id}"],
        ['DELETE', "/admin/cms/categories/{$category->id}"],
        ['GET', '/admin/cms/galleries'],
        ['POST', '/admin/cms/galleries'],
        ['GET', "/admin/cms/galleries/{$gallery->id}"],
        ['PUT', "/admin/cms/galleries/{$gallery->id}"],
        ['DELETE', "/admin/cms/galleries/{$gallery->id}"],
        ['POST', "/admin/cms/galleries/{$gallery->id}/photos"],
        ['DELETE', "/admin/cms/galleries/photos/{$photo->id}"],
        ['GET', '/admin/cms/teachers'],
        ['POST', '/admin/cms/teachers'],
        ['PUT', "/admin/cms/teachers/{$teacher->id}"],
        ['DELETE', "/admin/cms/teachers/{$teacher->id}"],
        ['GET', '/admin/cms/settings'],
        ['POST', '/admin/cms/settings'],
    ];

    foreach ($routes as [$method, $uri]) {
        $response = $this->call($method, $uri);
        expect($response->status())->toBe(403, "Expected 403 Forbidden for admin_psb on {$method} {$uri}");
    }
});

test('adversarial challenge 3: admin_cms authorized access to posts, categories, galleries, teachers vs super_admin settings boundary', function () {
    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $this->actingAs($adminCms);

    // 1. admin_cms can access CMS dashboard, posts, categories, galleries, teachers
    $this->get('/admin/cms')->assertOk()->assertSee('Manajemen Konten & Warta');
    $this->get('/admin/cms/posts')->assertOk()->assertSee('Daftar Artikel Berita');
    $this->get('/admin/cms/posts/create')->assertOk()->assertSee('Tulis Artikel Baru');
    $this->get('/admin/cms/categories')->assertOk()->assertSee('Kategori Artikel & Warta');
    $this->get('/admin/cms/galleries')->assertOk()->assertSee('Galeri Foto Dokumentasi');
    $this->get('/admin/cms/teachers')->assertOk()->assertSee('Dewan Asatidz & Pengajar');

    // 2. Gate manage-settings evaluation
    expect(Gate::allows('manage-settings'))->toBeFalse();

    // 3. Empirically verify admin_cms is forbidden from /admin/cms/settings
    // Note: Route is guarded by can:manage-settings, strictly blocking admin_cms
    $adminCmsSettingsResponse = $this->get('/admin/cms/settings');
    $adminCmsSettingsResponse->assertForbidden();

    // 3. Super Admin has full access to settings
    $superAdmin = User::factory()->create(['role' => UserRole::SuperAdmin]);
    $this->actingAs($superAdmin);

    expect(Gate::allows('manage-settings'))->toBeTrue();
    $this->get('/admin/cms/settings')->assertOk()->assertSee('Pengaturan Sistem & Situs');

    $updateSettingsResponse = $this->post('/admin/cms/settings', [
        'school_name' => 'PPMTQ Daar El Tazkiyah Sumardi Updated',
        'psb_whatsapp_number' => '6281234567890',
        'monthly_fee_mts' => 150000,
    ]);
    $updateSettingsResponse->assertSessionHasNoErrors();
    expect(SiteSetting::get('school_name'))->toBe('PPMTQ Daar El Tazkiyah Sumardi Updated');
});

test('adversarial challenge 4: Post CRUD integrity with validation errors, unique slug collision, and soft deletion', function () {
    Storage::fake('public');

    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $this->actingAs($adminCms);

    $category = Category::create(['name' => 'Pendidikan Islam', 'slug' => 'pendidikan-islam']);

    // 1. Validation Failures on Create
    // A. Missing required fields
    $this->post('/admin/cms/posts', [])
        ->assertSessionHasErrors(['title', 'content', 'status']);

    // B. Invalid status enum
    $this->post('/admin/cms/posts', [
        'title' => 'Judul Artikel',
        'content' => 'Konten artikel',
        'status' => 'invalid_status_enum',
    ])->assertSessionHasErrors(['status']);

    // C. Invalid category_id (non-existent ULID)
    $this->post('/admin/cms/posts', [
        'title' => 'Judul Artikel',
        'content' => 'Konten artikel',
        'status' => 'published',
        'category_id' => '01AN4Z07BY79KA1307SR9X4MV3',
    ])->assertSessionHasErrors(['category_id']);

    // D. Invalid image type (e.g. text file instead of image)
    $fakeTxt = UploadedFile::fake()->create('document.txt', 50, 'text/plain');
    $this->post('/admin/cms/posts', [
        'title' => 'Judul Artikel',
        'content' => 'Konten artikel',
        'status' => 'published',
        'featured_image' => $fakeTxt,
    ])->assertSessionHasErrors(['featured_image']);

    // E. Oversized image (>2048 KB)
    $oversizedImg = UploadedFile::fake()->image('huge.jpg')->size(2500);
    $this->post('/admin/cms/posts', [
        'title' => 'Judul Artikel',
        'content' => 'Konten artikel',
        'status' => 'published',
        'featured_image' => $oversizedImg,
    ])->assertSessionHasErrors(['featured_image']);

    // 2. Successful Post Creation
    $validImage = UploadedFile::fake()->image('cover.jpg', 800, 600)->size(500);
    $createResponse = $this->post('/admin/cms/posts', [
        'title' => 'Santri Berprestasi Lomba Kaligrafi Nasional',
        'slug' => 'santri-berprestasi-lomba-kaligrafi',
        'category_id' => $category->id,
        'content' => '<p>Santri kami meraih juara 1 nasional.</p>',
        'excerpt' => 'Prestasi gemilang santri Daar El Tazkiyah.',
        'status' => 'published',
        'published_at' => now()->toDateTimeString(),
        'featured_image' => $validImage,
        'meta_title' => 'Juara Kaligrafi Nasional',
        'meta_description' => 'Prestasi santri Daar El Tazkiyah',
    ]);

    $createResponse->assertRedirect(route('admin.cms.posts.index'));
    $createResponse->assertSessionHasNoErrors();

    $post = Post::where('slug', 'santri-berprestasi-lomba-kaligrafi')->first();
    expect($post)->not->toBeNull();
    expect($post->author_id)->toBe($adminCms->id);
    expect($post->featured_image)->not->toBeNull();
    Storage::disk('public')->assertExists($post->featured_image);

    // 3. Collision: Duplicate slug on create must be rejected
    $duplicateResponse = $this->post('/admin/cms/posts', [
        'title' => 'Santri Berprestasi Lomba Kaligrafi Nasional Duplicate',
        'slug' => 'santri-berprestasi-lomba-kaligrafi',
        'content' => '<p>Konten lain.</p>',
        'status' => 'draft',
    ]);
    $duplicateResponse->assertSessionHasErrors(['slug']);

    // 4. Update Post: Updating same post with same slug succeeds (Rule::unique ignore)
    $updateResponse = $this->put("/admin/cms/posts/{$post->id}", [
        'title' => 'Santri Berprestasi Lomba Kaligrafi Nasional (Updated)',
        'slug' => 'santri-berprestasi-lomba-kaligrafi',
        'content' => '<p>Konten diperbarui dengan daftar juara lengkap.</p>',
        'status' => 'published',
    ]);
    $updateResponse->assertSessionHasNoErrors();
    $post->refresh();
    expect($post->title)->toBe('Santri Berprestasi Lomba Kaligrafi Nasional (Updated)');

    // 5. Update Post: Collision with another post slug fails
    $post2 = Post::create([
        'author_id' => $adminCms->id,
        'title' => 'Artikel Kedua',
        'slug' => 'artikel-kedua',
        'content' => 'Konten kedua',
        'status' => PostStatus::Published,
    ]);

    $collisionUpdate = $this->put("/admin/cms/posts/{$post2->id}", [
        'title' => 'Mencoba Bajak Slug Post 1',
        'slug' => 'santri-berprestasi-lomba-kaligrafi',
        'content' => 'Konten bajak',
        'status' => 'published',
    ]);
    $collisionUpdate->assertSessionHasErrors(['slug']);

    // 6. Soft Delete Integrity
    $deleteResponse = $this->delete("/admin/cms/posts/{$post->id}");
    $deleteResponse->assertSessionHasNoErrors();

    expect(Post::find($post->id))->toBeNull(); // Excluded from normal query
    expect(Post::withTrashed()->find($post->id))->not->toBeNull(); // Retained in database
    expect(Post::withTrashed()->find($post->id)->deleted_at)->not->toBeNull();
});

test('adversarial challenge 5: Teacher photo upload verification on storage/app/public/teachers/ and photo_path column', function () {
    Storage::fake('public');

    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $this->actingAs($adminCms);

    // 1. Validation Failures
    $this->post('/admin/cms/teachers', [])
        ->assertSessionHasErrors(['full_name', 'role_title']);

    $fakeFile = UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf');
    $this->post('/admin/cms/teachers', [
        'full_name' => 'Ust. Hamzah, M.Pd.',
        'role_title' => 'Kepala Madrasah',
        'photo' => $fakeFile,
    ])->assertSessionHasErrors(['photo']);

    // 2. Create Teacher with Photo
    $photoFile = UploadedFile::fake()->image('ust_hamzah.jpg', 600, 800)->size(800);
    $response = $this->post('/admin/cms/teachers', [
        'full_name' => 'Ust. Hamzah, M.Pd.',
        'role_title' => 'Kepala Madrasah MTS',
        'bio' => 'Lulusan Magister Pendidikan Islam.',
        'specialization' => 'Tafsir & Ushul Fiqih',
        'sort_order' => 1,
        'is_active' => true,
        'photo' => $photoFile,
    ]);

    $response->assertSessionHasNoErrors();

    $teacher = Teacher::where('full_name', 'Ust. Hamzah, M.Pd.')->first();
    expect($teacher)->not->toBeNull();

    // Verify photo_path column value
    expect($teacher->photo_path)->not->toBeNull();
    expect($teacher->photo_path)->toStartWith('teachers/');

    // Verify physical file storage on disk
    Storage::disk('public')->assertExists($teacher->photo_path);

    // 3. Update Teacher: Retains existing photo if no new photo provided
    $updateResponse = $this->put("/admin/cms/teachers/{$teacher->id}", [
        'full_name' => 'Ust. Hamzah, M.Pd. (Revisi Gelar)',
        'role_title' => 'Direktur Pendidikan',
        'sort_order' => 1,
    ]);
    $updateResponse->assertSessionHasNoErrors();
    $teacher->refresh();
    expect($teacher->full_name)->toBe('Ust. Hamzah, M.Pd. (Revisi Gelar)');
    expect($teacher->role_title)->toBe('Direktur Pendidikan');
    expect($teacher->photo_path)->not->toBeNull();
    Storage::disk('public')->assertExists($teacher->photo_path);

    // 4. Update Teacher: Uploading a new photo replaces the photo_path
    $newPhoto = UploadedFile::fake()->image('ust_hamzah_new.png', 600, 800)->size(400);
    $updatePhotoResponse = $this->put("/admin/cms/teachers/{$teacher->id}", [
        'full_name' => 'Ust. Hamzah, M.Pd.',
        'role_title' => 'Direktur Pendidikan',
        'photo' => $newPhoto,
    ]);
    $updatePhotoResponse->assertSessionHasNoErrors();
    $teacher->refresh();
    expect($teacher->photo_path)->toStartWith('teachers/');
    Storage::disk('public')->assertExists($teacher->photo_path);

    // 5. Soft Delete Teacher
    $deleteResponse = $this->delete("/admin/cms/teachers/{$teacher->id}");
    $deleteResponse->assertSessionHasNoErrors();
    expect(Teacher::find($teacher->id))->toBeNull();
    expect(Teacher::withTrashed()->find($teacher->id)->deleted_at)->not->toBeNull();
});

test('adversarial challenge 6: Category parent-child hierarchy, root scope isolation, and foreign key constraints', function () {
    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $this->actingAs($adminCms);

    // 1. Validation Failures
    $this->post('/admin/cms/categories', [])
        ->assertSessionHasErrors(['name']);

    $this->post('/admin/cms/categories', [
        'name' => 'Kategori Baru',
        'parent_id' => '01AN4Z07BY79KA1307SR9X4MV3', // non-existent parent
    ])->assertSessionHasErrors(['parent_id']);

    // 2. Create Root Category
    $rootResponse = $this->post('/admin/cms/categories', [
        'name' => 'Pendidikan & Kurikulum',
        'slug' => 'pendidikan-kurikulum',
    ]);
    $rootResponse->assertSessionHasNoErrors();
    $rootCat = Category::where('slug', 'pendidikan-kurikulum')->first();
    expect($rootCat)->not->toBeNull();
    expect($rootCat->parent_id)->toBeNull();

    // 3. Create Child Category linked to Root
    $child1Response = $this->post('/admin/cms/categories', [
        'name' => 'Tahfidz Al-Quran',
        'slug' => 'tahfidz-al-quran',
        'parent_id' => $rootCat->id,
    ]);
    $child1Response->assertSessionHasNoErrors();
    $child1 = Category::where('slug', 'tahfidz-al-quran')->first();
    expect($child1)->not->toBeNull();
    expect($child1->parent_id)->toBe($rootCat->id);

    // 4. Create Second Child Category linked to Root
    $child2Response = $this->post('/admin/cms/categories', [
        'name' => 'Kajian Kitab Kuning',
        'slug' => 'kajian-kitab-kuning',
        'parent_id' => $rootCat->id,
    ]);
    $child2Response->assertSessionHasNoErrors();
    $child2 = Category::where('slug', 'kajian-kitab-kuning')->first();
    expect($child2->parent_id)->toBe($rootCat->id);

    // 5. Test Eloquent Relationship Integrity
    expect($child1->parent->id)->toBe($rootCat->id);
    expect($rootCat->children)->toHaveCount(2);
    expect($rootCat->children->pluck('id')->all())->toContain($child1->id, $child2->id);

    // 6. Test Category::scopeRoot() isolation
    $rootCategories = Category::root()->get();
    expect($rootCategories->pluck('id')->all())->toContain($rootCat->id);
    expect($rootCategories->pluck('id')->all())->not->toContain($child1->id);
    expect($rootCategories->pluck('id')->all())->not->toContain($child2->id);

    // 7. Update Category: Unique slug ignore route id
    $updateResponse = $this->put("/admin/cms/categories/{$child1->id}", [
        'name' => 'Tahfidz Al-Quran 30 Juz',
        'slug' => 'tahfidz-al-quran', // same slug
        'parent_id' => $rootCat->id,
    ]);
    $updateResponse->assertSessionHasNoErrors();
    $child1->refresh();
    expect($child1->name)->toBe('Tahfidz Al-Quran 30 Juz');

    // 8. Update Category: Collision with existing slug fails
    $collisionResponse = $this->put("/admin/cms/categories/{$child2->id}", [
        'name' => 'Kajian Duplikat',
        'slug' => 'tahfidz-al-quran', // belongs to child1
    ]);
    $collisionResponse->assertSessionHasErrors(['slug']);
});

test('adversarial challenge 7: Gallery multi-photo sequential upload, sort order increments, and single photo deletion', function () {
    Storage::fake('public');

    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $this->actingAs($adminCms);

    // 1. Album Creation Validation
    $this->post('/admin/cms/galleries', [])
        ->assertSessionHasErrors(['title']);

    // 2. Successful Album Creation with Cover
    $cover = UploadedFile::fake()->image('cover_wisuda.jpg', 1200, 800)->size(600);
    $albumResponse = $this->post('/admin/cms/galleries', [
        'title' => 'Dokumentasi Wisuda Santri Angkatan I',
        'slug' => 'wisuda-santri-angkatan-1',
        'description' => 'Momen kebahagiaan wisuda santri.',
        'event_date' => '2027-03-20',
        'cover_image' => $cover,
        'is_published' => true,
    ]);
    $albumResponse->assertSessionHasNoErrors();

    $gallery = Gallery::where('slug', 'wisuda-santri-angkatan-1')->first();
    expect($gallery)->not->toBeNull();
    expect($gallery->cover_image)->not->toBeNull();
    Storage::disk('public')->assertExists($gallery->cover_image);

    // 3. Upload Gallery Photos Validation Failures
    // A. Empty request
    $this->post("/admin/cms/galleries/{$gallery->id}/photos", [])
        ->assertSessionHasErrors(['photos']);

    // B. Invalid file inside photos array (PDF instead of image)
    $fakePdf = UploadedFile::fake()->create('document.pdf', 50, 'application/pdf');
    $this->post("/admin/cms/galleries/{$gallery->id}/photos", [
        'photos' => [$fakePdf],
    ])->assertSessionHasErrors(['photos.0']);

    // C. Oversized photo inside array (>4096 KB)
    $hugeImg = UploadedFile::fake()->image('huge.jpg')->size(5000);
    $this->post("/admin/cms/galleries/{$gallery->id}/photos", [
        'photos' => [$hugeImg],
    ])->assertSessionHasErrors(['photos.0']);

    // 4. Batch 1: Upload 3 Valid Photos at once
    $photoA = UploadedFile::fake()->image('photo_a.jpg', 800, 600)->size(500);
    $photoB = UploadedFile::fake()->image('photo_b.jpg', 800, 600)->size(500);
    $photoC = UploadedFile::fake()->image('photo_c.jpg', 800, 600)->size(500);

    $batch1Response = $this->post("/admin/cms/galleries/{$gallery->id}/photos", [
        'photos' => [$photoA, $photoB, $photoC],
        'caption' => 'Prosesi wisuda khidmat',
    ]);
    $batch1Response->assertSessionHasNoErrors();

    $photos = GalleryPhoto::where('gallery_id', $gallery->id)->orderBy('sort_order')->get();
    expect($photos)->toHaveCount(3);

    // Check sequential sort orders: 1, 2, 3
    expect($photos[0]->sort_order)->toBe(1);
    expect($photos[1]->sort_order)->toBe(2);
    expect($photos[2]->sort_order)->toBe(3);

    // Check captions and disk storage
    foreach ($photos as $p) {
        expect($p->caption)->toBe('Prosesi wisuda khidmat');
        expect($p->file_path)->toStartWith('galleries/photos/');
        Storage::disk('public')->assertExists($p->file_path);
    }

    // 5. Batch 2: Upload 2 More Photos -> Sort Order must increment from 4 to 5
    $photoD = UploadedFile::fake()->image('photo_d.jpg', 800, 600)->size(500);
    $photoE = UploadedFile::fake()->image('photo_e.jpg', 800, 600)->size(500);

    $batch2Response = $this->post("/admin/cms/galleries/{$gallery->id}/photos", [
        'photos' => [$photoD, $photoE],
        'caption' => 'Foto bersama asatidz',
    ]);
    $batch2Response->assertSessionHasNoErrors();

    $allPhotos = GalleryPhoto::where('gallery_id', $gallery->id)->orderBy('sort_order')->get();
    expect($allPhotos)->toHaveCount(5);
    expect($allPhotos[3]->sort_order)->toBe(4);
    expect($allPhotos[4]->sort_order)->toBe(5);
    expect($allPhotos[3]->caption)->toBe('Foto bersama asatidz');

    // 6. Delete a single photo
    $photoToDelete = $allPhotos[2]; // 3rd photo
    $deletePhotoResponse = $this->delete("/admin/cms/galleries/photos/{$photoToDelete->id}");
    $deletePhotoResponse->assertSessionHasNoErrors();

    expect(GalleryPhoto::find($photoToDelete->id))->toBeNull();
    expect(GalleryPhoto::where('gallery_id', $gallery->id)->count())->toBe(4);

    // 7. Soft Delete Album
    $deleteAlbumResponse = $this->delete("/admin/cms/galleries/{$gallery->id}");
    $deleteAlbumResponse->assertRedirect(route('admin.cms.galleries.index'));

    expect(Gallery::find($gallery->id))->toBeNull();
    expect(Gallery::withTrashed()->find($gallery->id)->deleted_at)->not->toBeNull();
});

test('adversarial challenge 8: UTF-8 Arabic calligraphy and rich HTML block storage in Post content', function () {
    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $this->actingAs($adminCms);

    $arabicTitle = 'افتتاح الدورة الصيفية لحفظ القرآن الكريم ١٤٤٨ هـ';
    $arabicContent = '<blockquote><p>بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p></blockquote><p>الحمد لله رب العالمين والصلاة والسلام على أشرف الأنبياء والمرسلين.</p>';

    $response = $this->post('/admin/cms/posts', [
        'title' => $arabicTitle,
        'content' => $arabicContent,
        'status' => 'published',
        'published_at' => now()->toDateTimeString(),
    ]);

    $response->assertRedirect(route('admin.cms.posts.index'));
    $response->assertSessionHasNoErrors();

    $post = Post::where('title', $arabicTitle)->first();
    expect($post)->not->toBeNull();
    expect($post->content)->toBe($arabicContent);
    expect($post->slug)->not->toBeEmpty();
});

test('adversarial challenge 9: Post scheduled status and auto-published_at timestamp assignment', function () {
    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $this->actingAs($adminCms);

    // Case 1: Status published without published_at -> controller auto-assigns now()
    $response1 = $this->post('/admin/cms/posts', [
        'title' => 'Post Auto Published At',
        'content' => 'Konten warta tanpa tanggal publikasi manual.',
        'status' => 'published',
        'published_at' => null,
    ]);
    $response1->assertSessionHasNoErrors();
    $post1 = Post::where('title', 'Post Auto Published At')->first();
    expect($post1)->not->toBeNull();
    expect($post1->published_at)->not->toBeNull();

    // Case 2: Status scheduled with future published_at
    $futureTime = now()->addDays(7)->startOfMinute();
    $response2 = $this->post('/admin/cms/posts', [
        'title' => 'Post Scheduled Future',
        'content' => 'Konten warta masa depan.',
        'status' => 'scheduled',
        'published_at' => $futureTime->toDateTimeString(),
    ]);
    $response2->assertSessionHasNoErrors();
    $post2 = Post::where('title', 'Post Scheduled Future')->first();
    expect($post2)->not->toBeNull();
    expect($post2->status)->toBe(PostStatus::Scheduled);
    expect($post2->published_at?->toDateTimeString())->toBe($futureTime->toDateTimeString());
});

test('adversarial challenge 10: Forensic empirical analysis of settings RBAC boundary (admin_cms vs super_admin)', function () {
    $adminCms = User::factory()->create(['role' => UserRole::AdminCms]);
    $superAdmin = User::factory()->create(['role' => UserRole::SuperAdmin]);

    // 1. AppServiceProvider Gate definition verification
    expect(Gate::forUser($superAdmin)->allows('manage-settings'))->toBeTrue();
    expect(Gate::forUser($adminCms)->allows('manage-settings'))->toBeFalse();

    // 2. Sidebar blade navigation verification: 'Pengaturan Situs' is guarded by @can('manage-settings')
    $this->actingAs($superAdmin);
    $superAdminView = $this->get('/admin/cms/posts');
    $superAdminView->assertOk()->assertSee('Pengaturan Situs');

    $this->actingAs($adminCms);
    $adminCmsView = $this->get('/admin/cms/posts');
    $adminCmsView->assertOk()->assertDontSee('Pengaturan Situs');

    // 3. Route & Request RBAC boundary enforcement:
    // admin_cms is strictly forbidden (HTTP 403) from accessing GET and POST /admin/cms/settings
    $adminCmsGetResponse = $this->get('/admin/cms/settings');
    $adminCmsGetResponse->assertForbidden();

    $adminCmsPostResponse = $this->post('/admin/cms/settings', [
        'school_name' => 'Daar El Tazkiyah Altered by CMS Admin',
    ]);
    $adminCmsPostResponse->assertForbidden();
    expect(SiteSetting::get('school_name'))->not->toBe('Daar El Tazkiyah Altered by CMS Admin');

    // 4. Super Admin retains full access and update capability
    $this->actingAs($superAdmin);
    $superAdminGetResponse = $this->get('/admin/cms/settings');
    $superAdminGetResponse->assertOk()->assertSee('Pengaturan Sistem & Situs');

    $superAdminPostResponse = $this->post('/admin/cms/settings', [
        'school_name' => 'Daar El Tazkiyah Authorized Super Admin Update',
        'psb_whatsapp_number' => '6281122334455',
        'monthly_fee_mts' => 1250000,
    ]);
    $superAdminPostResponse->assertSessionHasNoErrors()->assertRedirect();
    expect(SiteSetting::get('school_name'))->toBe('Daar El Tazkiyah Authorized Super Admin Update');
    expect(SiteSetting::get('psb_whatsapp_number'))->toBe('6281122334455');
});
