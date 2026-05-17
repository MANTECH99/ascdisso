<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['nom' => 'Téléphones & Tablettes', 'image' => 'categories/phones.jpg', 'ordre' => 1],
            ['nom' => 'Mode Homme', 'image' => 'categories/mode-homme.jpg', 'ordre' => 2],
            ['nom' => 'Mode Femme', 'image' => 'categories/mode-femme.jpg', 'ordre' => 3],
            ['nom' => 'Électronique', 'image' => 'categories/electronique.jpg', 'ordre' => 4],
            ['nom' => 'Maison & Cuisine', 'image' => 'categories/maison.jpg', 'ordre' => 5],
            ['nom' => 'Beauté & Bien-être', 'image' => 'categories/beaute.jpg', 'ordre' => 6],
            ['nom' => 'Sport & Loisirs', 'image' => 'categories/sport.jpg', 'ordre' => 7],
            ['nom' => 'Alimentation', 'image' => 'categories/alimentation.jpg', 'ordre' => 8],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ ' . count($categories) . ' catégories créées avec succès !');
    }
}