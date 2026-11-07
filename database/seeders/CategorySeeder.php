<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Berita Utama',
                'slug' => 'berita-utama',
            ],
            [
                'name' => 'Prestasi Santri',
                'slug' => 'prestasi-santri',
            ],
            [
                'name' => 'Kegiatan Santri',
                'slug' => 'kegiatan-santri',
            ],
            [
                'name' => 'Pengumuman PSB',
                'slug' => 'pengumuman-psb',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
