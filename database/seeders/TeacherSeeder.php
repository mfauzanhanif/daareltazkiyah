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
                'full_name' => 'Ust. Ahmad Ashil Fadhil, S.H., M.H.',
                'role_title' => 'Pengasuh Pondok Pesantren',
                'bio' => 'Alumni Fakultas Syariah & Hukum dengan komitmen teguh mendidik generasi Qur\'ani yang berakhlak mulia dan berwawasan hukum Islam kontemporer.',
                'specialization' => 'Tafsir & Fiqih Muamalah',
                'photo_path' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ust. Muhammad Ridhwan, Al-Hafidz',
                'role_title' => 'Kepala Madrasah & Pembimbing Tahfidz',
                'bio' => 'Hafidz 30 Juz bersanad muttashil, berpengalaman lebih dari 10 tahun membina santri tahfidz mukim dan intensif sanad tajwid.',
                'specialization' => 'Tahfidzul Qur\'an & Qira\'at',
                'photo_path' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ustadzah Nurul Hidayah, S.Pd.I',
                'role_title' => 'Wakil Pengasuh Bidang Keputrian',
                'bio' => 'Pendidik berdedikasi membimbing adab, tata krama, serta kemahiran berbahasa Arab untuk santriwati mukim.',
                'specialization' => 'Bahasa Arab & Akhlak Lil Banat',
                'photo_path' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'full_name' => 'Ust. Farhan Syuhada, S.Ag',
                'role_title' => 'Tenaga Pendidik MDTA & Diniyah',
                'bio' => 'Lulusan Ma\'had Aly dengan penguasaan gramatika Arab klasik dan tarikh tasyri\' Islam.',
                'specialization' => 'Nahwu, Sharaf & Tarikh Islam',
                'photo_path' => null,
                'sort_order' => 4,
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
