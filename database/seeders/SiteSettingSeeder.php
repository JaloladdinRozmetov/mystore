<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'site'],
            [
                'value' => [
                    'store_name'     => 'UzbekAI Store',
                    'support_email'  => 'support@example.com',
                    'support_phone'  => '+998 90 123 45 67',
                    'primary_color'  => '#0ea5e9',
                    'currency'       => 'UZS',
                    'logo_url'       => 'https://example.com/logo.png',
                    'footer_text'    => '© ' . date('Y') . ' UzbekAI. All rights reserved.',
                ]
            ]
        );
    }
}
