<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'full_name' => 'Ibu Hj. Dati Sumiyati',
                'role_title' => 'Pembina & Pendidik Pesantren',
                'bio' => 'Pembina senior berdedikasi membimbing kurikulum pendidikan formal, akhlak santri, dan manajemen kepesantrenan.',
                'specialization' => 'Pendidikan Islam & Manajemen Kurikulum',
                'photo_path' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ust. Ahmad Ashil Fadhil',
                'role_title' => 'Pengasuh Pondok Pesantren',
                'bio' => 'Pengasuh Pondok Pesantren Modern Tahfidzul Qur\'an Daar El Tazkiyah Sumardi, alumni perguruan tinggi syariah & hukum Islam dengan komitmen mencetak generasi Qur\'ani mutqin bersanad.',
                'specialization' => 'Tafsir, Hadits & Hukum Islam',
                'photo_path' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'full_name' => 'Bapak Dzaki Waliyyuddin',
                'role_title' => 'Tenaga Pendidik & Pembina IT',
                'bio' => 'Pendidik bidang sains terapan, teknologi informasi, dan pengembangan potensi analitis serta kepramukaan santri.',
                'specialization' => 'Teknologi Informasi & Sains',
                'photo_path' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ustz. Cicih Jubaedah',
                'role_title' => 'Tenaga Pendidik & Pembina Santriwati',
                'bio' => 'Pendidik berpengalaman membina pembelajaran bahasa, adab Islami, dan ketertiban asrama santriwati.',
                'specialization' => 'Bahasa & Pembinaan Akhlak',
                'photo_path' => null,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ustz. Nafa Firdausi Nuzula',
                'role_title' => 'Tenaga Pendidik & Musyrifah Tahfidz',
                'bio' => 'Pembimbing tahfidz Al-Qur\'an, setoran sabaq-manzil, dan pembelajaran diniyah santriwati.',
                'specialization' => 'Tahfidzul Qur\'an & Tajwid',
                'photo_path' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ustz. Siti Nurhasanah',
                'role_title' => 'Musyrifah & Pengajar Diniyah',
                'bio' => 'Pembina tahsin Al-Qur\'an dan pengajar dasar-dasar kitab kuning di madrasah diniyah.',
                'specialization' => 'Tahsin Qur\'an & Diniyah',
                'photo_path' => null,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ust. Abah Eman',
                'role_title' => 'Sesepuh & Pembimbing Rohani',
                'bio' => 'Tokoh pembimbing spiritual dan keteladanan ibadah amaliah santri di lingkungan pesantren.',
                'specialization' => 'Bimbingan Rohani & Adab',
                'photo_path' => null,
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ust. Dadang',
                'role_title' => 'Tenaga Pendidik & Pembimbing Lapangan',
                'bio' => 'Pembina kedisiplinan harian santri mukim, ketertiban asrama, dan kegiatan ekstrakurikuler.',
                'specialization' => 'Kedisiplinan & Ekstrakurikuler',
                'photo_path' => null,
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ibu Syalwa Putri Hermawan',
                'role_title' => 'Tenaga Kependidikan & Tata Usaha',
                'bio' => 'Pengelola administrasi akademik, kesekretariatan PSB, dan pelayanan wali santri.',
                'specialization' => 'Administrasi & Layanan Santri',
                'photo_path' => null,
                'sort_order' => 9,
                'is_active' => true,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(
                ['full_name' => $teacher['full_name']],
                $teacher
            );
        }
    }
}
