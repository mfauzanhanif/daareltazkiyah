<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Enums\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\Psb\CheckStatusRequest;
use App\Http\Requests\Portal\Psb\StoreApplicantRequest;
use App\Http\Requests\Portal\Psb\UpdateApplicantRequest;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use App\Models\ApplicantDocument;
use App\Services\PdfService;
use App\Services\RegistrationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class PsbController extends Controller
{
    public function index(Request $request): View
    {
        $activeWave = AdmissionWave::currentActive();
        $selectedProgram = (string) $request->query('program', 'MTS');
        $feeMts = $activeWave ? number_format($activeWave->fee_mts, 0, ',', '.') : '100.000';
        $feeMdta = $activeWave ? number_format($activeWave->fee_mdta, 0, ',', '.') : '25.000';

        return view('public.psb.index', compact('activeWave', 'selectedProgram', 'feeMts', 'feeMdta'));
    }

    public function fee(Request $request): View
    {
        $activeWave = AdmissionWave::currentActive();
        $feeMts = $activeWave ? number_format($activeWave->fee_mts, 0, ',', '.') : '100.000';
        $feeMdta = $activeWave ? number_format($activeWave->fee_mdta, 0, ',', '.') : '25.000';

        return view('public.psb.fee', compact('activeWave', 'feeMts', 'feeMdta'));
    }

    public function equipment(Request $request): View
    {
        $activeWave = AdmissionWave::currentActive();

        return view('public.psb.equipment', compact('activeWave'));
    }

    public function form(Request $request): View
    {
        $activeWave = AdmissionWave::currentActive();
        $selectedProgram = (string) $request->query('program', 'MTS');

        return view('public.psb.form', compact('activeWave', 'selectedProgram'));
    }

    public function store(StoreApplicantRequest $request, RegistrationService $registrationService): RedirectResponse
    {
        $applicant = $registrationService->register($request->validated(), $request->allFiles());

        return redirect()->route('psb.success', $applicant->registration_number)
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function success(string $registration_number): View
    {
        $applicant = Applicant::query()
            ->where('registration_number', $registration_number)
            ->with(['admissionWave', 'parent', 'documents'])
            ->firstOrFail();

        return view('public.psb.success', compact('applicant'));
    }

    public function downloadProof(string $registration_number, PdfService $pdfService): Response
    {
        $applicant = Applicant::query()
            ->where('registration_number', $registration_number)
            ->with(['admissionWave', 'parent', 'documents'])
            ->firstOrFail();

        return $pdfService->generateProof($applicant);
    }

    public function statusForm(): View
    {
        return view('public.psb.status');
    }

    public function checkStatus(CheckStatusRequest $request): View
    {
        $regNumber = trim((string) $request->validated('registration_number'));
        $nik = $request->validated('nik');
        $token = $request->validated('access_token');

        $query = Applicant::query();

        // Support exact match, YYNNNN shorthand (e.g. 260001 -> PSB-2026-%-0001), and full PSB format
        if (preg_match('/^(\d{2})(\d{4})$/', $regNumber, $m)) {
            $fullYear = '20'.$m[1];
            $seq = $m[2];
            $query->where(function ($q) use ($regNumber, $fullYear, $seq): void {
                $q->where('registration_number', $regNumber)
                    ->orWhere('registration_number', 'like', "PSB-{$fullYear}-%-{$seq}");
            });
        } elseif (preg_match('/^PSB-(\d{4})-[A-Z]+-(\d{4})$/', $regNumber, $m)) {
            $shortReg = substr($m[1], -2).$m[2];
            $query->where(function ($q) use ($regNumber, $shortReg): void {
                $q->where('registration_number', $regNumber)
                    ->orWhere('registration_number', $shortReg);
            });
        } else {
            $query->where('registration_number', $regNumber);
        }

        if (! empty($nik)) {
            $rawNik = (string) $nik;
            $digitsNik = preg_replace('/[^0-9]/', '', $rawNik);
            $query->where(function ($q) use ($rawNik, $digitsNik): void {
                $q->where('nik', $rawNik);
                if (! empty($digitsNik) && $digitsNik !== $rawNik) {
                    $q->orWhere('nik', $digitsNik);
                }
            });
        } elseif (! empty($token)) {
            $query->where('access_token', (string) $token);
        }

        $applicant = $query->with(['admissionWave', 'parent', 'documents'])->first();

        if (! $applicant) {
            throw ValidationException::withMessages([
                'registration_number' => 'Kombinasi Nomor Pendaftaran dan NIK tidak ditemukan.',
            ]);
        }

        return view('public.psb.status-result', compact('applicant'));
    }

    public function update(UpdateApplicantRequest $request, string $registration_number): RedirectResponse
    {
        /** @var Applicant $applicant */
        $applicant = Applicant::query()
            ->where('registration_number', $registration_number)
            ->where('access_token', (string) $request->input('access_token'))
            ->with(['parent', 'documents'])
            ->firstOrFail();

        if (! $applicant->canBeEdited()) {
            abort(403, 'Data pendaftaran sudah dikunci dan tidak dapat diubah.');
        }

        DB::transaction(function () use ($request, $applicant): void {
            $fields = $request->only([
                'full_name',
                'gender',
                'birth_place',
                'birth_date',
                'child_order',
                'previous_school',
                'address',
            ]);
            $cleanFields = array_filter($fields, fn (mixed $val): bool => $val !== null);
            if (! empty($cleanFields)) {
                $applicant->update($cleanFields);
            }

            $parentFields = $request->only([
                'father_name',
                'mother_name',
                'father_job',
                'mother_job',
                'parent_income',
                'parent_phone',
                'parent_address',
            ]);
            $cleanParentFields = array_filter($parentFields, fn (mixed $val): bool => $val !== null);
            if (! empty($cleanParentFields)) {
                if ($applicant->parent) {
                    $applicant->parent->update($cleanParentFields);
                } else {
                    $applicant->parent()->create(array_merge([
                        'applicant_id' => $applicant->id,
                        'father_name' => '-',
                        'mother_name' => '-',
                        'parent_phone' => '-',
                    ], $cleanParentFields));
                }
            }

            $disk = config('filesystems.disks.private') ? 'private' : 'local';
            $docKeys = [
                'document_photo' => 'photo',
                'document_kk' => 'kk',
                'document_akta' => 'akta',
                'document_payment' => 'payment_proof',
            ];

            foreach ($docKeys as $inputKey => $docType) {
                if ($request->hasFile($inputKey)) {
                    $file = $request->file($inputKey);
                    if ($file !== null) {
                        $path = $file->store("applicants/{$applicant->id}", $disk);

                        ApplicantDocument::updateOrCreate(
                            ['applicant_id' => $applicant->id, 'document_type' => $docType],
                            [
                                'file_path' => $path,
                                'original_name' => $file->getClientOriginalName(),
                            ]
                        );
                    }
                }
            }

            if ($applicant->application_status === ApplicationStatus::RevisionNeeded) {
                $applicant->application_status = ApplicationStatus::Pending;
                $applicant->save();

                activity('psb_applicant')
                    ->performedOn($applicant)
                    ->log("Pendaftar {$applicant->registration_number} telah mengunggah perbaikan data/berkas. Status otomatis kembali ke pending.");
            }
        });

        return back()->with('success', 'Data pendaftaran berhasil diperbarui.');
    }
}
