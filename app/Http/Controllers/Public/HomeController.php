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

final class HomeController extends Controller
{
    public function __invoke(): View
    {
        $activeWave = AdmissionWave::currentActive();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $pengasuh = $teachers->firstWhere('sort_order', 2)
            ?? $teachers->firstWhere('role_title', 'Pengasuh Pondok Pesantren');

        $latestPosts = Post::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $featuredPost = $latestPosts->first();
        $recentPosts = $latestPosts->skip(1);

        $latestGalleries = Gallery::query()
            ->where('is_published', true)
            ->with('photos')
            ->orderBy('sort_order')
            ->latest('event_date')
            ->take(6)
            ->get();

        $feeMts = $activeWave ? number_format($activeWave->fee_mts, 0, ',', '.') : '100.000';
        $feeMdta = $activeWave ? number_format($activeWave->fee_mdta, 0, ',', '.') : '25.000';

        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '0896-5332-4339');
        $waMdtaNumber = (string) SiteSetting::get('psb_whatsapp_mdta_number', '0895-0718-4811');
        $siteAddress = (string) SiteSetting::get('school_address', 'RT 006 / RW 002, Kp. Lembur Sawah, Desa Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten');
        $sitePhone = (string) SiteSetting::get('school_phone', '0896-5332-4339');
        $siteEmail = (string) SiteSetting::get('school_email', 'info@daareltazkiyah.sch.id');

        return view('public.home', compact(
            'activeWave',
            'teachers',
            'pengasuh',
            'featuredPost',
            'recentPosts',
            'latestPosts',
            'latestGalleries',
            'feeMts',
            'feeMdta',
            'waNumber',
            'waMdtaNumber',
            'siteAddress',
            'sitePhone',
            'siteEmail'
        ));
    }
}
