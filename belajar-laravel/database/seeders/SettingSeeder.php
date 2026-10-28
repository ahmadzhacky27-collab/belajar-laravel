<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'PPKD Sticker',
                'label' => 'Nama Lembaga / Website',
                'group' => 'general',
                'type' => 'text',
            ],
            [
                'key' => 'site_logo',
                'value' => 'null',
                'label' => 'Logo Utama Website',
                'group' => 'general',
                'type' => 'image',
            ],
        ];
        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
