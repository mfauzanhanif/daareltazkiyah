<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

final class ProgramController extends Controller
{
    /**
     * Display the comprehensive Program page (Program Unggulan, Program Pendidikan MTs/MDTA, Ekstrakurikuler).
     */
    public function index(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $feeMts = $activeWave ? number_format($activeWave->fee_mts, 0, ',', '.') : '100.000';
        $feeMdta = $activeWave ? number_format($activeWave->fee_mdta, 0, ',', '.') : '25.000';
        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '0896-5332-4339');
        $waMdtaNumber = (string) SiteSetting::get('psb_whatsapp_mdta_number', '0895-0718-4811');

        return view('public.program.index', compact(
            'activeWave',
            'feeMts',
            'feeMdta',
            'waNumber',
            'waMdtaNumber'
        ));
    }
}
