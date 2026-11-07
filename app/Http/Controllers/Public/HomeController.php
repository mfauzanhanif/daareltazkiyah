<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $activeWave = AdmissionWave::currentActive();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $latestPosts = Post::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestGalleries = Gallery::query()
            ->where('is_published', true)
            ->with('photos')
            ->orderBy('sort_order')
            ->latest('event_date')
            ->take(6)
            ->get();

        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '6281234567890');
        $siteAddress = (string) SiteSetting::get('school_address', SiteSetting::get('site_address', 'Jl. Cibanteng Babengket, RT 02 / RW 02, Desa Cihideung Udik, Kec. Ciampea, Kab. Bogor, Jawa Barat 16620'));
        $sitePhone = (string) SiteSetting::get('school_phone', SiteSetting::get('site_phone', '0812-3456-7890'));
        $siteEmail = (string) SiteSetting::get('school_email', SiteSetting::get('site_email', 'info@daareltazkiyah.sch.id'));

        return view('pages.public.home', compact(
            'activeWave',
            'teachers',
            'latestPosts',
            'latestGalleries',
            'waNumber',
            'siteAddress',
            'sitePhone',
            'siteEmail'
        ));
    }
}
