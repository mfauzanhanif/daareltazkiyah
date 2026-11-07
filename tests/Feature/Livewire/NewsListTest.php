<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Enums\PostStatus;
use App\Livewire\Public\NewsList;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('news list component renders published posts and excludes drafts', function () {
    $author = User::factory()->create();
    $category = Category::create([
        'name' => 'Warta Pondok',
        'slug' => 'warta-pondok',
    ]);

    $published = Post::create([
        'title' => 'Santri Mengikuti Ujian Tahfidz Nasional',
        'slug' => 'santri-mengikuti-ujian-tahfidz-nasional',
        'content' => 'Alhamdulillah santri berhasil mengikuti ujian dengan baik.',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
        'author_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $draft = Post::create([
        'title' => 'Draf Rencana Kegiatan Ramadhan',
        'slug' => 'draf-rencana-kegiatan-ramadhan',
        'content' => 'Konten rahasia draf kegiatan.',
        'status' => PostStatus::Draft,
        'published_at' => null,
        'author_id' => $author->id,
        'category_id' => $category->id,
    ]);

    Livewire::test(NewsList::class)
        ->assertOk()
        ->assertSee('Santri Mengikuti Ujian Tahfidz Nasional')
        ->assertDontSee('Draf Rencana Kegiatan Ramadhan');
});

test('news list component filters posts reactively by category', function () {
    $author = User::factory()->create();

    $cat1 = Category::create([
        'name' => 'Prestasi',
        'slug' => 'prestasi',
    ]);

    $cat2 = Category::create([
        'name' => 'Kajian',
        'slug' => 'kajian',
    ]);

    $post1 = Post::create([
        'title' => 'Juara 1 Musabaqah Hifdzil Quran',
        'slug' => 'juara-1-musabaqah-hifdzil-quran',
        'content' => 'Prestasi tingkat nasional.',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
        'author_id' => $author->id,
        'category_id' => $cat1->id,
    ]);

    $post2 = Post::create([
        'title' => 'Kajian Rutin Hadits Arbain',
        'slug' => 'kajian-rutin-hadits-arbain',
        'content' => 'Kajian setiap subuh.',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
        'author_id' => $author->id,
        'category_id' => $cat2->id,
    ]);

    Livewire::test(NewsList::class)
        ->call('setCategory', 'prestasi')
        ->assertSee('Juara 1 Musabaqah Hifdzil Quran')
        ->assertDontSee('Kajian Rutin Hadits Arbain')
        ->call('setCategory', 'kajian')
        ->assertSee('Kajian Rutin Hadits Arbain')
        ->assertDontSee('Juara 1 Musabaqah Hifdzil Quran');
});

test('news list component searches posts reactively by keyword and resets filters', function () {
    $author = User::factory()->create();

    Post::create([
        'title' => 'Peringatan Hari Santri Nasional',
        'slug' => 'peringatan-hari-santri-nasional',
        'content' => 'Upacara khidmat seluruh santri dan ustadz.',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
        'author_id' => $author->id,
    ]);

    Post::create([
        'title' => 'Peresmian Gedung Laboratorium Bahasa',
        'slug' => 'peresmian-gedung-laboratorium-bahasa',
        'content' => 'Fasilitas baru untuk pembelajaran bahasa Arab.',
        'status' => PostStatus::Published,
        'published_at' => now()->subDay(),
        'author_id' => $author->id,
    ]);

    Livewire::test(NewsList::class)
        ->set('search', 'Laboratorium')
        ->assertSee('Peresmian Gedung Laboratorium Bahasa')
        ->assertDontSee('Peringatan Hari Santri Nasional')
        ->call('resetFilters')
        ->assertSee('Peresmian Gedung Laboratorium Bahasa')
        ->assertSee('Peringatan Hari Santri Nasional');
});
