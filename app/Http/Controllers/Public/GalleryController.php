<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Contracts\View\View;

final class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::query()
            ->published()
            ->ordered()
            ->with('photos')
            ->paginate(12);

        return view('public.gallery.index', compact('galleries'));
    }
}
