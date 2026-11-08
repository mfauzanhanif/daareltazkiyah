<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class GalleryController extends Controller
{
    /**
     * Display the Pinterest-style masonry photo gallery with interactive categories.
     */
    public function index(Request $request): View
    {
        $category = $request->query('kategori');

        $query = Gallery::query()
            ->published()
            ->ordered()
            ->with('photos');

        if ($category && $category !== 'semua') {
            $query->where(function ($q) use ($category) {
                $q->where('title', 'like', "%{$category}%")
                    ->orWhere('description', 'like', "%{$category}%");
            });
        }

        $galleries = $query->paginate(12);

        return view('public.gallery.index', compact('galleries', 'category'));
    }
}
