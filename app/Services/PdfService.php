<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Applicant;
use App\Models\SiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

final class PdfService
{
    /**
     * Generate official A4 PDF confirmation document for applicant.
     */
    public function generateProof(Applicant $applicant): Response
    {
        $applicant->loadMissing(['admissionWave', 'parent', 'documents']);

        $settings = [
            'school_name' => (string) SiteSetting::get('school_name', 'Pondok Pesantren Modern Tahfidzul Qur\'an Daar El Tazkiyah Sumardi'),
            'school_address' => (string) SiteSetting::get('school_address', 'Jl. Cibanteng Babengket RT 02/02, Desa Cihideung Udik, Kec. Ciampea, Kab. Bogor, Jawa Barat'),
            'school_phone' => (string) SiteSetting::get('school_phone', '0812-3456-7890'),
            'school_email' => (string) SiteSetting::get('school_email', 'info@daareltazkiyah.sch.id'),
            'bank_name' => (string) SiteSetting::get('bank_name', 'Bank Syariah Indonesia (BSI)'),
            'bank_account_number' => (string) SiteSetting::get('bank_account_number', '7123456789'),
            'bank_account_name' => (string) SiteSetting::get('bank_account_name', 'PPMTQ DAAR EL TAZKIYAH'),
        ];

        /** @var \Barryvdh\DomPDF\PDF $pdf */
        $pdf = Pdf::loadView('public.psb.proof-pdf', compact('applicant', 'settings'))
            ->setPaper('a4', 'portrait')
            ->setOption('isRemoteEnabled', true)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('defaultFont', 'DejaVu Sans');

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"Bukti-Pendaftaran-{$applicant->registration_number}.pdf\"",
        ]);
    }
}
