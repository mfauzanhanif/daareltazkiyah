<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page with interactive map, secretariat hours, and visit scheduling.
     */
    public function index(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '6281234567890');
        $siteAddress = (string) SiteSetting::get('school_address', SiteSetting::get('site_address', 'Jl. Cibanteng Babengket, RT 02 / RW 02, Desa Cihideung Udik, Kec. Ciampea, Kab. Bogor, Jawa Barat 16620'));
        $sitePhone = (string) SiteSetting::get('school_phone', SiteSetting::get('site_phone', '0812-3456-7890'));
        $siteEmail = (string) SiteSetting::get('school_email', SiteSetting::get('site_email', 'info@daareltazkiyah.sch.id'));

        return view('pages.public.contact', compact(
            'activeWave',
            'waNumber',
            'siteAddress',
            'sitePhone',
            'siteEmail'
        ));
    }

    /**
     * Handle consultation or campus visit reservation request.
     */
    public function sendConsultation(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'parent_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'visit_date' => ['nullable', 'date'],
            'program_interest' => ['required', 'string', 'in:MTS,MDTA,UMUM'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '6281234567890');
        $cleanWa = preg_replace('/[^0-9]/', '', $waNumber);

        $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh.\n";
        $message .= "Saya ingin menjadwalkan silaturahmi / konsultasi pondok:\n";
        $message .= "Nama Wali: {$validated['parent_name']}\n";
        $message .= "No. WhatsApp: {$validated['phone']}\n";
        $message .= "Minat Program: {$validated['program_interest']}\n";
        if (! empty($validated['visit_date'])) {
            $message .= "Rencana Kunjungan: {$validated['visit_date']}\n";
        }
        if (! empty($validated['notes'])) {
            $message .= "Catatan: {$validated['notes']}\n";
        }

        $waUrl = "https://wa.me/{$cleanWa}?text=".urlencode($message);

        return redirect()->away($waUrl);
    }
}
