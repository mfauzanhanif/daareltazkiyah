<?php

declare(strict_types=1);

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('scheduled news post automatically becomes published when published_at timestamp is reached', function () {
    if (! Schema::hasTable('posts') || ! Schema::hasTable('users')) {
        test()->markTestSkipped('Posts or Users tables not yet migrated (M1 required).');
    }

    $authorId = (string) Str::ulid();
    DB::table('users')->insert([
        'id' => $authorId,
        'name' => 'Editor Pondok',
        'email' => 'editor@daareltazkiyah.com',
        'password' => bcrypt('password'),
        'role' => 'admin_cms',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $postId = (string) Str::ulid();
    $scheduledTime = now()->addHours(3);

    DB::table('posts')->insert([
        'id' => $postId,
        'author_id' => $authorId,
        'title' => 'Pengumuman Libur Awal Ramadhan 1448 H',
        'slug' => 'pengumuman-libur-awal-ramadhan-1448-h',
        'content' => 'Pemberitahuan jadwal libur santri menjelang bulan suci Ramadhan.',
        'status' => 'scheduled',
        'published_at' => $scheduledTime->toDateTimeString(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // 1. Prior to scheduled time: post must NOT be visible on /berita
    $preResponse = $this->get('/berita');
    if ($preResponse->status() === 404) {
        test()->markTestSkipped('News listing route not yet registered (M3 required).');
    }

    $preResponse->assertOk()
        ->assertDontSee('Pengumuman Libur Awal Ramadhan 1448 H');

    // 2. Advance time past scheduled timestamp
    Carbon::setTestNow($scheduledTime->copy()->addMinutes(15));

    // Execute scheduler or publishing contract
    if (class_exists(Post::class) && method_exists(Post::class, 'publishSchedule')) {
        Post::publishSchedule();
    } else {
        // Fallback or artisan schedule:run
        Artisan::call('schedule:run');
    }

    // Post in database should now be published or published scope returns it
    $post = DB::table('posts')->where('id', $postId)->first();
    expect($post->status)->toBe('published');

    // 3. Post should now appear on public news listing
    $postResponse = $this->get('/berita');
    $postResponse->assertOk()
        ->assertSee('Pengumuman Libur Awal Ramadhan 1448 H');

    Carbon::setTestNow(); // Reset clock
});
