<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\SiteSetting;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;

final class ProfileController extends Controller
{
    /**
     * Display the comprehensive Profile page (Selayang Pandang, Visi & Misi, Fasilitas, Pendidik).
     */
    public function index(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $pengasuh = $teachers->firstWhere('sort_order', 2)
            ?? $teachers->firstWhere('role_title', 'Pengasuh Pondok Pesantren');

        $siteAddress = (string) SiteSetting::get('school_address', 'RT 006 / RW 002, Kp. Lembur Sawah, Desa Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten');
        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '0895-0718-4811');

        return view('public.profile.index', compact(
            'activeWave',
            'teachers',
            'pengasuh',
            'siteAddress',
            'waNumber'
        ));
    }
}
