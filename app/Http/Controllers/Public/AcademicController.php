<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class AcademicController extends Controller
{
    /**
     * Display the full curriculum and boarding program for MTS (Mukim 24 Jam).
     */
    public function mts(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $feeMts = $activeWave ? number_format($activeWave->fee_mts, 0, ',', '.') : '100.000';
        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '6281234567890');

        return view('public.academic.mts', compact('activeWave', 'feeMts', 'waNumber'));
    }

    /**
     * Display the Madrasah Diniyah Takmiliyah Awaliyah (MDTA) afternoon program.
     */
    public function mdta(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $feeMdta = $activeWave ? number_format($activeWave->fee_mdta, 0, ',', '.') : '25.000';
        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '6281234567890');

        return view('public.academic.mdta', compact('activeWave', 'feeMdta', 'waNumber'));
    }

    /**
     * Display the Tahfidzul Qur'an 30 Juz Bersanad and Kitab Kuning curriculum.
     */
    public function tahfidz(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '6281234567890');

        return view('public.academic.tahfidz', compact('activeWave', 'waNumber'));
    }
}
