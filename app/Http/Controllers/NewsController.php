<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostView;
use Illuminate\Contracts\View\View;

final class NewsController extends Controller
{
    public function index(): View
    {
        return view('pages.public.news.index');
    }

    public function show(string $slug): View
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->published()
            ->with(['category', 'author', 'views'])
            ->firstOrFail();

        // Record aggregated post view for today
        PostView::recordView($post->id);

        $relatedPosts = Post::query()
            ->where('id', '!=', $post->id)
            ->published()
            ->when($post->category_id, fn ($q) => $q->where('category_id', $post->category_id))
            ->with(['category', 'author', 'views'])
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.public.news.show', compact('post', 'relatedPosts'));
    }
}
