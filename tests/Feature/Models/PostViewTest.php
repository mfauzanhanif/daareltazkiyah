<?php

declare(strict_types=1);

namespace Tests\Feature\Models;

use App\Enums\PostStatus;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

test('recordView increments view count without database errors and returns the model', function () {
    $author = User::create([
        'name' => 'Penulis',
        'email' => 'penulis@example.com',
        'password' => 'password123',
        'role' => UserRole::AdminCms,
    ]);

    $category = Category::create([
        'name' => 'Artikel',
        'slug' => 'artikel',
    ]);

    $post = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Artikel Uji View Count',
        'slug' => 'artikel-uji-view-count',
        'content' => '<p>Konten artikel.</p>',
        'status' => PostStatus::Published,
        'published_at' => now(),
    ]);

    $view = PostView::recordView($post->id);

    expect($view)->toBeInstanceOf(PostView::class)
        ->and($view->post_id)->toBe($post->id)
        ->and($view->count)->toBe(1)
        ->and($view->viewed_at->toDateString())->toBe(now()->toDateString());

    $this->assertDatabaseHas('post_views', [
        'id' => $view->id,
        'post_id' => $post->id,
        'count' => 1,
    ]);

    $secondView = PostView::recordView($post->id);

    expect($secondView)->toBeInstanceOf(PostView::class)
        ->and($secondView->id)->toBe($view->id)
        ->and($secondView->count)->toBe(2);

    expect(PostView::where('post_id', $post->id)->count())->toBe(1);
});

test('totalViews returns sum from query or loaded relation to prevent n plus 1 queries', function () {
    $author = User::create([
        'name' => 'Penulis 2',
        'email' => 'penulis2@example.com',
        'password' => 'password123',
        'role' => UserRole::AdminCms,
    ]);

    $category = Category::create([
        'name' => 'Pengumuman',
        'slug' => 'pengumuman',
    ]);

    $post = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Pengumuman Penting',
        'slug' => 'pengumuman-penting',
        'content' => '<p>Isi pengumuman.</p>',
        'status' => PostStatus::Published,
        'published_at' => now(),
    ]);

    PostView::recordView($post->id, Carbon::parse('2026-11-01'));
    PostView::recordView($post->id, Carbon::parse('2026-11-02'));
    PostView::recordView($post->id, Carbon::parse('2026-11-02'));

    // Test when views relation is not loaded (uses query)
    expect($post->relationLoaded('views'))->toBeFalse();
    expect($post->totalViews())->toBe(3);

    // Test when views relation is loaded (uses in-memory collection sum)
    $post->load('views');
    expect($post->relationLoaded('views'))->toBeTrue();
    expect($post->totalViews())->toBe(3);
});
