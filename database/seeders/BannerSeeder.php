<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run()
    {
        $banners = [
            ['image_path' => 'banners/banner1.jpg', 'ordre' => 1, 'is_active' => true],
            ['image_path' => 'banners/banner2.jpg', 'ordre' => 2, 'is_active' => true],
            ['image_path' => 'banners/banner3.jpg', 'ordre' => 3, 'is_active' => true],
            ['image_path' => 'banners/banner4.jpg', 'ordre' => 4, 'is_active' => true],
            ['image_path' => 'banners/banner5.jpg', 'ordre' => 5, 'is_active' => true],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        $this->command->info('✅ 6 bannières créées avec succès !');
    }
}