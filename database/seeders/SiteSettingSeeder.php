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
                'key' => 'school_tagline',
                'value' => 'Mencetak Generasi Qur\'ani, Berakhlak Mulia, dan Berwawasan Global',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'school_address',
                'value' => 'Jl. Pangeran Drajat No. 45, Kesambi, Kota Cirebon, Jawa Barat 45134',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'school_phone',
                'value' => '(0231) 882233',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'school_email',
                'value' => 'info@daareltazkiyah.sch.id',
                'group' => SettingGroup::General,
            ],
            [
                'key' => 'maps_embed_url',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.339234839212!2d108.5523!3d-6.7321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNDMnNTUuNiJTIDEwOMKwMzMnMDguMyJF!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid',
                'group' => SettingGroup::General,
            ],

            // PSB Information
            [
                'key' => 'psb_whatsapp_number',
                'value' => '6281234567890',
                'group' => SettingGroup::Psb,
            ],
            [
                'key' => 'psb_whatsapp_greeting',
                'value' => 'Assalamu\'alaikum Panitia PSB PPMTQ Daar El Tazkiyah, saya ingin bertanya perihal pendaftaran santri baru.',
                'group' => SettingGroup::Psb,
            ],
            [
                'key' => 'psb_contact_person',
                'value' => 'Ustadzah Fatimah, S.Pd.I',
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
                'value' => 'PPMTQ DAAR EL TAZKIYAH',
                'group' => SettingGroup::Billing,
            ],
            [
                'key' => 'bank_account_number',
                'value' => '7123456789',
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
                'value' => 'https://facebook.com/daareltazkiyah',
                'group' => SettingGroup::SocialMedia,
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/daareltazkiyah',
                'group' => SettingGroup::SocialMedia,
            ],
            [
                'key' => 'youtube_url',
                'value' => 'https://youtube.com/@daareltazkiyah',
                'group' => SettingGroup::SocialMedia,
            ],
            [
                'key' => 'tiktok_url',
                'value' => 'https://tiktok.com/@daareltazkiyah',
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
