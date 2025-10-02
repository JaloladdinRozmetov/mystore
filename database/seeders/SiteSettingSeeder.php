<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;


class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        try {
            SiteSetting::set('site',
                [
                        'store_name'     => 'IDEALMETER',
                        'support_email'  => 'info@idealmeter.uz',
                        'support_phone'  => '+99877-282-00-01',
                        'primary_color'  => '#0ea5e9',
                        'currency'       => 'UZS',
                        'address'       => '“IDEALMETER” MCHJ Toshkent shahar
Olmazor tumani Yangi Olmazor ko’chasi 51
(Olmazor Kichik Sanoat Zonasi)',
                        'location'       => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3287.560340002042!2d69.24719141176863!3d41.350772098145626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8dae166e88c1%3A0x2755e74629ee273f!2z0K_QvdCz0Lgg0J7Qu9C80LDQt9Cw0YAg0YPQu9C40YbQsCA1MSwg0KLQsNGI0LrQtdC90YIsIFRhc2hrZW50LCDQo9C30LHQtdC60LjRgdGC0LDQvQ!5e1!3m2!1sru!2s!4v1759241066162!5m2!1sru!2s",
                        'logo_url'       => 'public/acuas/img/logo.png',
                        'footer_text'    => '© ' . date('Y') . ' IDEALMETER. All rights reserved.',
                ]
            );
        }catch (Exception $exception){
            var_dump($exception->getMessage());
        }
    }
}
