<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Exports\ApplicantsExport;
use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class AdminPsbController extends Controller
{
    public function dashboard(): View
    {
        $totalApplicants = Applicant::count();
        $mtsCount = Applicant::where('program_type', 'MTS')->count();
        $mdtaCount = Applicant::where('program_type', 'MDTA')->count();

        $verifiedCount = Applicant::where('application_status', 'verified')->count();
        $acceptedCount = Applicant::where('application_status', 'accepted')->count();
        $pendingCount = Applicant::where('application_status', 'pending')->count();
        $revisionCount = Applicant::where('application_status', 'revision_needed')->count();
        $paidCount = Applicant::where('payment_status', 'paid')->count();

        $recentApplicants = Applicant::with(['admissionWave', 'parent'])->latest()->take(10)->get();
        $activeWave = AdmissionWave::currentActive();

        return view('pages.admin.psb.dashboard', compact(
            'totalApplicants',
            'mtsCount',
            'mdtaCount',
            'verifiedCount',
            'acceptedCount',
            'pendingCount',
            'revisionCount',
            'paidCount',
            'recentApplicants',
            'activeWave'
        ));
    }

    public function indexApplicants(Request $request): View
    {
        $query = Applicant::with(['admissionWave', 'parent', 'documents'])->latest();

        if ($request->filled('search')) {
            $search = (string) $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('program')) {
            $query->where('program_type', $request->input('program'));
        }

        if ($request->filled('status')) {
            $query->where('application_status', $request->input('status'));
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->input('payment_status'));
        }

        $applicants = $query->paginate(15)->withQueryString();
        $waves = AdmissionWave::latest()->get();

        return view('pages.admin.psb.applicants.index', compact('applicants', 'waves'));
    }

    public function showApplicant(string $id): View
    {
        $applicant = Applicant::with(['admissionWave', 'parent', 'documents', 'activities'])->findOrFail($id);

        return view('pages.admin.psb.applicants.show', compact('applicant'));
    }

    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);

        $validated = $request->validate([
            'application_status' => ['required', 'string'],
            'payment_status' => ['nullable', 'string'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $applicant->update([
            'application_status' => $validated['application_status'],
            'payment_status' => $validated['payment_status'] ?? $applicant->payment_status,
            'admin_notes' => $validated['admin_notes'] ?? $applicant->admin_notes,
        ]);

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function export(Request $request): BinaryFileResponse
    {
        $search = $request->query('search');
        $program = $request->query('program');
        $status = $request->query('status');

        $fileName = 'Pendaftar-PSB-'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new ApplicantsExport($search, $program, $status), $fileName);
    }
}
