<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\SettingGroup;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General & Contact
            [
                'key' => 'school_name',
                'value' => 'Pondok Pesantren Modern Tahfidzul Qur\'an Daar El Tazkiyah Sumardi',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'foundation_name',
                'value' => 'DAAR EL TAZKIYAH SUMARDI',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'mdta_unit_name',
                'value' => 'MDT Ula DAAR EL TAZKIYAH SUMARDI',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'mdta_ijop_number',
                'value' => '0355',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'mdta_ijop_full',
                'value' => 'Piagam Izin Operasional Penyelenggaraan Madrasah Diniyah Takmiliyah Ula Nomor: 0355 (Kemenag Kabupaten Serang, ditetapkan di Serang, 28 Oktober 2026)',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'mdta_nsmdt',
                'value' => '311236041251',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'established_date',
                'value' => '2025-06-23',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'school_tagline',
                'value' => 'Bersama Al-Qur\'an, Membangun Generasi Berakhlak Mulia',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'school_address',
                'value' => 'Kp. Lembur Sawah, Kel./Desa Mekar Baru, Kecamatan Petir, Kab. Serang, Provinsi Banten',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'school_phone',
                'value' => '0896-5332-4339',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'school_email',
                'value' => 'sekretariat@daareltazkiyahsumardi.ponpes.id',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'maps_embed_url',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.578647895476!2d106.2163931!3d-6.2081547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e423d24e1011867%3A0x6b2e3895e7b514ab!2sMekarbaru%2C%20Kec.%20Petir%2C%20Kabupaten%20Serang%2C%20Banten!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
                'group' => SettingGroup::General,
            ],

            // PSB Information
            [
                'key' => 'psb_whatsapp_number',
                'value' => '0896-5332-4339',
                'group' => SettingGroup::Psb,
            ],
            [
                'key' => 'psb_whatsapp_mdta_number',
                'value' => '0895-0718-4811',
                'group' => SettingGroup::Psb,
            ],
            [
                'key' => 'psb_whatsapp_greeting',
                'value' => 'Assalamu\'alaikum Ustadz, saya ingin bertanya perihal PPMTQ Daar El Tazkiyah.',
                'group' => SettingGroup::Psb,
            ],
            [
                'key' => 'psb_contact_person',
                'value' => 'Panitia PSB Daar El Tazkiyah',
                'group' => SettingGroup::Psb,
            ],

            // Billing & Accounts
            [
                'key' => 'bank_name',
                'value' => 'Bank Syariah Indonesia (BSI)',
                'group' => SettingGroup::Billing,
            ],
            [
                'key' => 'bank_account_name',
                'value' => 'Yayasan Daar El Tazkiyah Sumardi',
                'group' => SettingGroup::Billing,
            ],
            [
                'key' => 'bank_account_number',
                'value' => '7366764695',
                'group' => SettingGroup::Billing,
            ],
            [
                'key' => 'monthly_fee_mts',
                'value' => '500000',
                'group' => SettingGroup::Billing,
            ],
            [
                'key' => 'monthly_fee_mdta',
                'value' => '12000',
                'group' => SettingGroup::Billing,
            ],

            // Social Media
            [
                'key' => 'facebook_url',
                'value' => 'https://www.facebook.com/Daar-El-tazkiyah-Sumardi-61595393704791',
                'group' => SettingGroup::SocialMedia,
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://www.instagram.com/media_daareltazkiyah_sumardi',
                'group' => SettingGroup::SocialMedia,
            ],
            [
                'key' => 'tiktok_url',
                'value' => 'https://www.tiktok.com/@media.daareltazki',
                'group' => SettingGroup::SocialMedia,
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
