<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

final class ApplicantsExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(
        public ?string $search = null,
        public ?string $program = null,
        public ?string $status = null,
    ) {}

    public function query(): Builder
    {
        return Applicant::query()
            ->with(['admissionWave', 'parent'])
            ->when($this->search, function (Builder $query) {
                $search = $this->search;
                $query->where(function (Builder $q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('registration_number', 'like', "%{$search}%");
                });
            })
            ->when($this->program, fn (Builder $q) => $q->where('program_type', $this->program))
            ->when($this->status, fn (Builder $q) => $q->where('application_status', $this->status))
            ->latest();
    }

    public function headings(): array
    {
        return [
            'No. Registrasi',
            'Gelombang',
            'Program',
            'Nama Lengkap',
            'NIK',
            'NISN',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Asal Sekolah',
            'Nama Ayah',
            'Nama Ibu',
            'No. WhatsApp Ortu',
            'Alamat',
            'Biaya Pendaftaran',
            'Status Pembayaran',
            'Status Berkas',
            'Catatan Admin',
            'Tanggal Daftar',
        ];
    }

    /**
     * @param  Applicant  $applicant
     */
    public function map($applicant): array
    {
        return [
            $applicant->registration_number,
            $applicant->admissionWave ? $applicant->admissionWave->name : '-',
            $applicant->program_type->value,
            $applicant->full_name,
            $applicant->nik,
            $applicant->nisn ?? '-',
            $applicant->gender->value,
            $applicant->birth_place,
            $applicant->birth_date->format('d/m/Y'),
            $applicant->previous_school,
            $applicant->parent ? $applicant->parent->father_name : '-',
            $applicant->parent ? $applicant->parent->mother_name : '-',
            $applicant->parent ? $applicant->parent->parent_phone : '-',
            $applicant->address,
            $applicant->registration_fee,
            $applicant->payment_status->value,
            $applicant->application_status->value,
            $applicant->admin_notes ?? '-',
            $applicant->created_at ? $applicant->created_at->format('d/m/Y H:i') : '-',
        ];
    }
}
