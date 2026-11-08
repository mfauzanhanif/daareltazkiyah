<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\SiteSetting;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    /**
     * Display the comprehensive history, vision, mission, and institutional values.
     */
    public function sejarah(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $siteAddress = (string) SiteSetting::get('school_address', SiteSetting::get('site_address', 'Jl. Cibanteng Babengket, RT 02 / RW 02, Desa Cihideung Udik, Kec. Ciampea, Kab. Bogor, Jawa Barat 16620'));

        return view('pages.public.profile.sejarah', compact('activeWave', 'siteAddress'));
    }

    /**
     * Display the full council of Asatidz, scholars, and educators with their credentials.
     */
    public function teachers(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.public.profile.teachers', compact('activeWave', 'teachers'));
    }

    /**
     * Display the facilities, infrastructure, mosque, dorms, and learning environment.
     */
    public function facilities(): View
    {
        $activeWave = AdmissionWave::currentActive();

        return view('pages.public.profile.facilities', compact('activeWave'));
    }
}
