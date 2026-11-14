<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran - {{ $applicant->registration_number }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1.2cm;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #0F291E;
            font-size: 10pt;
            line-height: 1.4;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .page-container {
            border: 1px solid #084C27;
            padding: 18px 22px;
            min-height: 980px;
            box-sizing: border-box;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #084C27;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .header-table td.logo-cell {
            width: 65px;
            vertical-align: middle;
        }

        .logo-box {
            width: 54px;
            height: 54px;
            background-color: #084C27;
            color: #ffffff;
            font-weight: bold;
            font-size: 18pt;
            text-align: center;
            line-height: 54px;
            border-radius: 6px;
        }

        .header-table td.text-cell {
            vertical-align: middle;
            text-align: center;
        }

        .header-table h1 {
            color: #084C27;
            font-size: 13pt;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: bold;
        }

        .header-table h2 {
            color: #059669;
            font-size: 11pt;
            margin: 3px 0;
            font-weight: normal;
        }

        .header-table p {
            font-size: 8pt;
            color: #4B6358;
            margin: 1px 0;
        }

        .doc-title {
            text-align: center;
            margin: 12px 0;
        }

        .doc-title h3 {
            font-size: 12pt;
            color: #084C27;
            margin: 0;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-box {
            background-color: #FDFBF7;
            border: 1px solid #D97706;
            padding: 8px 12px;
            margin-bottom: 14px;
            border-radius: 4px;
        }

        .meta-box table {
            width: 100%;
        }

        .meta-box td {
            font-size: 9.5pt;
        }

        .section-title {
            font-size: 10pt;
            font-weight: bold;
            color: #084C27;
            background-color: #f0f7f3;
            padding: 3px 6px;
            margin-top: 10px;
            margin-bottom: 6px;
            border-left: 3px solid #084C27;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        table.data-table td {
            padding: 3px 6px;
            font-size: 9pt;
            vertical-align: top;
        }

        table.data-table td.label {
            width: 30%;
            color: #333333;
        }

        table.data-table td.colon {
            width: 3%;
        }

        table.data-table td.value {
            width: 67%;
            font-weight: 500;
        }

        .footer-signatures {
            margin-top: 20px;
            width: 100%;
        }

        .footer-signatures td {
            width: 50%;
            text-align: center;
            font-size: 9pt;
        }

        .signature-space {
            height: 48px;
        }

        .notes {
            margin-top: 16px;
            border-top: 1px dashed #cccccc;
            padding-top: 8px;
            font-size: 7.5pt;
            color: #555555;
        }

        .footer-timestamp {
            margin-top: 8px;
            font-size: 7pt;
            color: #888888;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="page-container">
        <!-- Header with Institution Identity -->
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <div class="logo-box">DT</div>
                </td>
                <td class="text-cell">
                    <h1>{{ $settings['school_name'] ?? 'Pondok Pesantren Modern Tahfidzul Qur\'an Daar El Tazkiyah Sumardi' }}
                    </h1>
                    <h2>Penerimaan Santri Baru (PSB) Tahun Ajaran
                        {{ $applicant->admissionWave?->academic_year ?? '2027/2028' }}</h2>
                    <p>{{ $settings['school_address'] ?? 'Kp. Lembur Sawah, Kel./Desa Mekar Baru, Kecamatan Petir, Kab. Serang, Provinsi Banten' }}
                    </p>
                    <p>Website: {{ $settings['school_website'] ?? 'www.daareltazkiyahsumardi.ponpes.id' }} &bull;
                        Telp/WA:
                        {{ $settings['school_phone'] ?? '0896-5332-4339' }}</p>
                </td>
            </tr>
        </table>

        <div class="doc-title">
            <h3>TANDA BUKTI PENDAFTARAN SANTRI BARU</h3>
        </div>

        <!-- Credentials & Wave Box -->
        <div class="meta-box">
            <table>
                <tr>
                    <td style="width: 50%;"><strong>Nomor Registrasi:</strong> <span
                            style="font-family: monospace; font-size: 11pt; font-weight: bold; color: #084C27;">{{ $applicant->registration_number }}</span>
                    </td>
                    <td style="width: 50%;"><strong>Gelombang:</strong>
                        {{ $applicant->admissionWave?->name ?? 'Gelombang I' }}
                        ({{ $applicant->admissionWave?->academic_year ?? '2027/2028' }})</td>
                </tr>
                <tr>
                    <td><strong>Token Akses Rahasia:</strong> <span
                            style="font-family: monospace; font-size: 11pt; font-weight: bold; color: #D97706;">{{ $applicant->access_token }}</span>
                    </td>
                    <td><strong>Jenjang / Program:</strong>
                        {{ $applicant->program_type->value ?? $applicant->program_type }}</td>
                </tr>
            </table>
        </div>

        <!-- I. Data Calon Santri -->
        <div class="section-title">I. DATA PRIBADI CALON SANTRI</div>
        <table class="data-table">
            <tr>
                <td class="label">Nama Lengkap Santri</td>
                <td class="colon">:</td>
                <td class="value"><strong>{{ $applicant->full_name }}</strong></td>
            </tr>
            <tr>
                <td class="label">NIK Santri</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->nik }}</td>
            </tr>
            <tr>
                <td class="label">NISN</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->nisn ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="colon">:</td>
                <td class="value">
                    {{ ($applicant->gender->value ?? $applicant->gender) === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </td>
            </tr>
            <tr>
                <td class="label">Tempat, Tanggal Lahir</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->birth_place }},
                    {{ $applicant->birth_date?->translatedFormat('d F Y') ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Anak ke-</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->child_order }}</td>
            </tr>
            <tr>
                <td class="label">Asal Sekolah (SD/MI)</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->previous_school }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->address }}</td>
            </tr>
        </table>

        <!-- II. Data Orang Tua / Wali -->
        <div class="section-title">II. DATA ORANG TUA / WALI</div>
        <table class="data-table">
            <tr>
                <td class="label">Nama Ayah Kandung</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->parent?->father_name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Nama Ibu Kandung</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->parent?->mother_name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan Ayah / Ibu</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->parent?->father_job ?? '-' }} /
                    {{ $applicant->parent?->mother_job ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Nomor WhatsApp Aktif</td>
                <td class="colon">:</td>
                <td class="value">{{ $applicant->parent?->parent_phone ?? '-' }}</td>
            </tr>
        </table>

        <!-- III. Rincian Biaya & Status Administrasi -->
        <div class="section-title">III. RINCIAN BIAYA & STATUS ADMINISTRASI</div>
        <table class="data-table">
            <tr>
                <td class="label">Infaq Pendaftaran</td>
                <td class="colon">:</td>
                <td class="value"><strong>Rp {{ number_format($applicant->registration_fee, 0, ',', '.') }}</strong>
                </td>
            </tr>
            <tr>
                <td class="label">Rekening Pembayaran</td>
                <td class="colon">:</td>
                <td class="value">{{ $settings['bank_name'] ?? 'Bank Syariah Indonesia (BSI)' }} No.
                    <strong>{{ $settings['bank_account_number'] ?? '7366764695' }}</strong> a.n.
                    {{ $settings['bank_account_name'] ?? 'Yayasan Daar El Tazkiyah Sumardi' }}
                </td>
            </tr>
            <tr>
                <td class="label">Status Verifikasi Berkas</td>
                <td class="colon">:</td>
                <td class="value"><span
                        style="color: #084C27; font-weight: bold;">{{ strtoupper($applicant->application_status->value ?? (string) $applicant->application_status) }}</span>
                </td>
            </tr>
            <tr>
                <td class="label">Status Pembayaran</td>
                <td class="colon">:</td>
                <td class="value"><span
                        style="color: #D97706; font-weight: bold;">{{ strtoupper($applicant->payment_status->value ?? (string) $applicant->payment_status) }}</span>
                </td>
            </tr>
        </table>

        <!-- Signatures Section -->
        <table class="footer-signatures">
            <tr>
                <td>
                    Bogor, {{ now()->translatedFormat('d F Y') }}<br>
                    Calon Wali Santri,
                    <div class="signature-space"></div>
                    ( <strong>{{ $applicant->parent?->father_name ?? $applicant->full_name }}</strong> )
                </td>
                <td>
                    Panitia Penerimaan Santri Baru,<br>
                    Ketua Pelaksana PSB,
                    <div class="signature-space"></div>
                    ( <strong>Panitia PSB PPMTQ</strong> )
                </td>
            </tr>
        </table>

        <!-- Instructions & Notes -->
        <div class="notes">
            <strong>PETUNJUK & KETENTUAN PENTING:</strong>
            <ol style="margin: 3px 0; padding-left: 16px;">
                <li>Cetak lembar bukti pendaftaran ini dan bawa saat pelaksanaan tes seleksi / wawancara observasi
                    santri.</li>
                <li>Simpan <strong>Nomor Registrasi</strong> dan <strong>Token Akses Rahasia</strong> untuk mengecek
                    perkembangan verifikasi dan status kelulusan di portal PSB (<code>/psb/status</code>).</li>
                <li>Konfirmasikan pendaftaran Anda kepada Panitia melalui WhatsApp dengan melampirkan berkas bukti
                    pendaftaran ini.</li>
            </ol>
        </div>

        <div class="footer-timestamp">
            Dokumen ini dibuat secara otomatis oleh sistem PSB Online pada {{ now()->translatedFormat('d F Y H:i:s') }}
            WIB
        </div>
    </div>

</body>

</html>
