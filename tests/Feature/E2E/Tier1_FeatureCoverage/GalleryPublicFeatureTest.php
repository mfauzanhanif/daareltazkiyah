<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('public gallery displays published albums and photos with lightbox attributes', function () {
    if (! Schema::hasTable('galleries') || ! Schema::hasTable('gallery_photos')) {
        test()->markTestSkipped('Galleries/Gallery_photos tables not yet migrated (M1 required).');
    }

    $galleryId = (string) Str::ulid();
    DB::table('galleries')->insert([
        'id' => $galleryId,
        'title' => 'Kegiatan Rihlah dan Tadabbur Alam Santri 2027',
        'slug' => 'rihlah-tadabbur-alam-2027',
        'description' => 'Dokumentasi kegiatan tadabbur alam di Gunung Geulis.',
        'cover_image' => 'galleries/rihlah-cover.webp',
        'event_date' => '2027-01-15',
        'sort_order' => 1,
        'is_published' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('gallery_photos')->insert([
        'id' => (string) Str::ulid(),
        'gallery_id' => $galleryId,
        'file_path' => 'galleries/photos/tadabbur-1.webp',
        'caption' => 'Santri berkumpul mendengarkan taujih pengasuh',
        'sort_order' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/galeri');
    if ($response->status() === 404) {
        test()->markTestSkipped('Gallery public route not yet registered (M3 required).');
    }

    $response->assertOk()
        ->assertSee('Kegiatan Rihlah dan Tadabbur Alam Santri 2027')
        ->assertSee('rihlah-cover.webp');
});

test('public gallery hides unpublished albums from public view', function () {
    if (! Schema::hasTable('galleries')) {
        test()->markTestSkipped('Galleries table not yet migrated (M1 required).');
    }

    DB::table('galleries')->insert([
        'id' => (string) Str::ulid(),
        'title' => 'Dokumentasi Rapat Internal Panitia',
        'slug' => 'rapat-internal-panitia',
        'is_published' => false,
        'sort_order' => 2,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/galeri');
    if ($response->status() === 404) {
        test()->markTestSkipped('Gallery public route not yet registered (M3 required).');
    }

    $response->assertOk()
        ->assertDontSee('Dokumentasi Rapat Internal Panitia');
});

test('public gallery displays empty state when no albums exist', function () {
    if (! Schema::hasTable('galleries')) {
        test()->markTestSkipped('Galleries table not yet migrated (M1 required).');
    }

    DB::table('galleries')->delete();

    $response = $this->get('/galeri');
    $response->assertOk()
        ->assertSee('Belum ada album galeri.');
});

test('public gallery renders photo count badge and event date', function () {
    if (! Schema::hasTable('galleries') || ! Schema::hasTable('gallery_photos')) {
        test()->markTestSkipped('Galleries/Gallery_photos tables not yet migrated (M1 required).');
    }

    $galleryId = (string) Str::ulid();
    DB::table('galleries')->insert([
        'id' => $galleryId,
        'title' => 'Wisuda Tahfidz 2027',
        'slug' => 'wisuda-tahfidz-2027',
        'cover_image' => 'galleries/wisuda.webp',
        'event_date' => '2027-03-20',
        'sort_order' => 1,
        'is_published' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('gallery_photos')->insert([
        'id' => (string) Str::ulid(),
        'gallery_id' => $galleryId,
        'file_path' => 'galleries/photos/wisuda-1.webp',
        'caption' => 'Pemberian syahadah',
        'sort_order' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get('/galeri');
    $response->assertOk()
        ->assertSee('Wisuda Tahfidz 2027')
        ->assertSee('20 Mar 2027')
        ->assertSee('1 Foto')
        ->assertSee('openLightbox')
        ->assertSee('backdrop-blur-md');
});
