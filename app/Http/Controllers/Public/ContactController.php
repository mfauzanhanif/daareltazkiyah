<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class ContactController extends Controller
{
    /**
     * Display the contact page with interactive map, secretariat hours, and visit scheduling.
     */
    public function index(): View
    {
        $activeWave = AdmissionWave::currentActive();
        $waNumber = (string) SiteSetting::get('psb_whatsapp_number', '0895-0718-4811');
        $waMdtaNumber = (string) SiteSetting::get('psb_whatsapp_mdta_number', '0858-8276-7078');
        $siteAddress = (string) SiteSetting::get('school_address', 'RT 006 / RW 002, Kp. Lembur Sawah, Desa Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten');
        $sitePhone = (string) SiteSetting::get('school_phone', '0895-0718-4811');
        $siteEmail = (string) SiteSetting::get('school_email', 'info@daareltazkiyah.sch.id');

        return view('public.contact', compact(
            'activeWave',
            'waNumber',
            'waMdtaNumber',
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

        $targetWa = $validated['program_interest'] === 'MDTA'
            ? (string) SiteSetting::get('psb_whatsapp_mdta_number', '0858-8276-7078')
            : (string) SiteSetting::get('psb_whatsapp_number', '0895-0718-4811');

        $cleanWa = preg_replace('/[^0-9]/', '', $targetWa);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62'.substr($cleanWa, 1);
        }

        $programLabel = match ($validated['program_interest']) {
            'MTS' => 'MTs (Madrasah Tsanawiyah Mukim 24 Jam)',
            'MDTA' => 'MDTA (Sekolah Sore Non-Mukim)',
            default => 'Konsultasi Umum Pesantren',
        };

        $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh.\n";
        $message .= "Saya ingin menjadwalkan silaturahmi / konsultasi pondok:\n";
        $message .= "Nama Wali: {$validated['parent_name']}\n";
        $message .= "No. WhatsApp: {$validated['phone']}\n";
        $message .= "Minat Program: {$programLabel}\n";
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
