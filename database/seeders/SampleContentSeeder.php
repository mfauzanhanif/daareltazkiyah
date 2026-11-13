<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class SampleContentSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();
        if (! $author) {
            return;
        }

        $catPsb = Category::where('slug', 'pengumuman-psb')->first();
        $catPrestasi = Category::where('slug', 'prestasi-santri')->first();
        $catKegiatan = Category::where('slug', 'kegiatan-santri')->first();

        // Sample Posts
        if ($catPsb) {
            Post::updateOrCreate(
                ['slug' => 'penerimaan-santri-baru-psb-2027-2028-resmi-dibuka'],
                [
                    'category_id' => $catPsb->id,
                    'author_id' => $author->id,
                    'title' => 'Penerimaan Santri Baru (PSB) Tahun Ajaran 2027/2028 Resmi Dibuka',
                    'excerpt' => 'PPMTQ Daar El Tazkiyah Sumardi secara resmi membuka pendaftaran santri baru jenjang MTS dan MDTA Gelombang I.',
                    'content' => '<p>Alhamdulillah, Pondok Pesantren Modern Tahfidzul Qur\'an Daar El Tazkiyah Sumardi secara resmi membuka pendaftaran santri baru untuk Tahun Ajaran 2027/2028.</p><p>Pendaftaran dibuka untuk dua jenjang pendidikan unggulan: Madrasah Tsanawiyah dan Madrasah Diniyah Takmiliyah Awaliyah. Calon santri dan wali santri dapat melakukan pendaftaran secara mandiri melalui website resmi ini.</p>',
                    'status' => PostStatus::Published,
                    'is_featured' => true,
                    'featured_image' => 'galleries/photos/foto-santri-3.webp',
                    'published_at' => now()->subDays(10),
                    'meta_title' => 'PSB 2027/2028 PPMTQ Daar El Tazkiyah Dibuka',
                    'meta_description' => 'Informasi lengkap pendaftaran santri baru MTS dan MDTA PPMTQ Daar El Tazkiyah Tahun Ajaran 2027/2028.',
                ]
            );
        }

        if ($catPrestasi) {
            Post::updateOrCreate(
                ['slug' => 'santri-daar-el-tazkiyah-raih-juara-1-mhq-jawa-barat'],
                [
                    'category_id' => $catPrestasi->id,
                    'author_id' => $author->id,
                    'title' => 'Santri Daar El Tazkiyah Raih Juara 1 Musabaqah Hifdzil Qur\'an Tingkat Jawa Barat',
                    'excerpt' => 'Prestasi membanggakan kembali ditorehkan santri PPMTQ Daar El Tazkiyah dalam ajang MHQ 10 Juz tingkat Provinsi Jawa Barat.',
                    'content' => '<p>Prestasi gemilang ditorehkan oleh santri PPMTQ Daar El Tazkiyah dalam kejuaraan MHQ 10 Juz tingkat Jawa Barat. Keberhasilan ini merupakan buah dari disiplin ziyadah dan murajaah harian yang dibina langsung oleh para asatidz tahfidz.</p>',
                    'status' => PostStatus::Published,
                    'is_featured' => true,
                    'featured_image' => 'galleries/photos/foto-santri-2.webp',
                    'published_at' => now()->subDays(5),
                    'meta_title' => 'Santri Daar El Tazkiyah Juara 1 MHQ Jabar',
                    'meta_description' => 'Santri PPMTQ Daar El Tazkiyah meraih Juara 1 dalam Musabaqah Hifdzil Quran tingkat Provinsi Jawa Barat.',
                ]
            );
        }

        if ($catKegiatan) {
            Post::updateOrCreate(
                ['slug' => 'kajian-bulanan-dan-tasmi-akbar-santri-daar-el-tazkiyah'],
                [
                    'category_id' => $catKegiatan->id,
                    'author_id' => $author->id,
                    'title' => 'Kajian Bulanan Bersama Pengasuh & Tasmi\' Akbar Santri',
                    'excerpt' => 'Momen kebersamaan santri, wali santri, dan pengasuh dalam tasmi\' akbar hafalan Al-Qur\'an dan siraman rohani bulanan.',
                    'content' => '<p>Kegiatan tasmi\' akbar sekali duduk 5 juz dan 10 juz rutin dilaksanakan setiap akhir bulan di masjid jami\' pondok pesantren, dihadiri oleh seluruh santri dan para wali santri.</p>',
                    'status' => PostStatus::Published,
                    'is_featured' => false,
                    'featured_image' => 'galleries/photos/foto-santri-1.webp',
                    'published_at' => now()->subDays(2),
                    'meta_title' => 'Kajian Bulanan & Tasmi Akbar Santri',
                    'meta_description' => 'Dokumentasi kegiatan tasmi akbar dan kajian bulanan santri PPMTQ Daar El Tazkiyah.',
                ]
            );
        }

        // Sample Galleries
        $album1 = Gallery::updateOrCreate(
            ['slug' => 'tasmi-akbar-30-juz-santri'],
            [
                'title' => 'Tasmi\' Akbar Hafalan 30 Juz Sekali Duduk',
                'description' => 'Dokumentasi ujian tasmi\' akbar santri tahfidz mukim disaksikan langsung oleh dewan asatidz dan para wali santri.',
                'event_date' => now()->subDays(15)->toDateString(),
                'cover_image' => 'galleries/photos/foto-santri-1.webp',
                'sort_order' => 1,
                'is_published' => true,
            ]
        );

        $album2 = Gallery::updateOrCreate(
            ['slug' => 'rihlah-ilmiah-dan-tadabbur-alam'],
            [
                'title' => 'Rihlah Ilmiah dan Tadabbur Alam Santri',
                'description' => 'Kegiatan luar ruangan mengasah kemandirian, ukhuwah islamiyah, dan kecintaan terhadap alam ciptaan Allah SWT.',
                'event_date' => now()->subDays(30)->toDateString(),
                'cover_image' => 'galleries/photos/foto-santri-2.webp',
                'sort_order' => 2,
                'is_published' => true,
            ]
        );

        $album3 = Gallery::updateOrCreate(
            ['slug' => 'dewan-pengajar-dan-asatidz-pesantren'],
            [
                'title' => 'Dewan Pengajar & Asatidz Pembimbing Santri',
                'description' => 'Keluarga besar pendidik dan asatidz huffadz Al-Qur\'an PPMTQ Daar El Tazkiyah Sumardi.',
                'event_date' => now()->subDays(45)->toDateString(),
                'cover_image' => 'galleries/photos/foto-pengajar.webp',
                'sort_order' => 3,
                'is_published' => true,
            ]
        );

        // Sample Gallery Photos entries
        GalleryPhoto::updateOrCreate(
            ['gallery_id' => $album1->id, 'file_path' => 'galleries/photos/foto-santri-1.webp'],
            ['caption' => 'Ujian Tasmi Al-Qur\'an Santri', 'sort_order' => 1]
        );
        GalleryPhoto::updateOrCreate(
            ['gallery_id' => $album1->id, 'file_path' => 'galleries/photos/foto-santri-3.webp'],
            ['caption' => 'Kebersamaan Santri Putra & Putri', 'sort_order' => 2]
        );
        GalleryPhoto::updateOrCreate(
            ['gallery_id' => $album2->id, 'file_path' => 'galleries/photos/foto-santri-2.webp'],
            ['caption' => 'Kajian Alam Terbuka & Tadabbur', 'sort_order' => 1]
        );
        GalleryPhoto::updateOrCreate(
            ['gallery_id' => $album3->id, 'file_path' => 'galleries/photos/foto-pengajar.webp'],
            ['caption' => 'Dewan Asatidz PPMTQ Daar El Tazkiyah', 'sort_order' => 1]
        );
    }
}
