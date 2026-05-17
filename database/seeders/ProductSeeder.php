<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Produit 1
        $product1 = Product::create([
            'category_id' => 1,
            'nom' => 'Samsung Galaxy A54',
            'description' => 'Smartphone Samsung Galaxy A54 5G - Écran 6.4" Super AMOLED - 8Go RAM - 128Go Stockage - Caméra 50MP - Batterie 5000mAh',
            'prix' => 185000,
            'prix_barre' => 225000,
            'pourcentage_reduction' => 18,
            'stock' => 25,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            ProductImage::create([
                'product_id' => $product1->id,
                'image_path' => 'products/samsung-a54-' . $i . '.jpg',
                'ordre' => $i,
            ]);
        }

        // Produit 2
        $product2 = Product::create([
            'category_id' => 1,
            'nom' => 'iPhone 13 Pro Max',
            'description' => 'Apple iPhone 13 Pro Max - Écran 6.7" Super Retina XDR - 6Go RAM - 256Go - Caméra 12MP Pro - Face ID',
            'prix' => 550000,
            'prix_barre' => 650000,
            'pourcentage_reduction' => 15,
            'stock' => 10,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            ProductImage::create([
                'product_id' => $product2->id,
                'image_path' => 'products/iphone-13-' . $i . '.jpg',
                'ordre' => $i,
            ]);
        }

        // Produit 3
        $product3 = Product::create([
            'category_id' => 2,
            'nom' => 'Costume Homme Classique',
            'description' => 'Costume homme classique - Veste + Pantalon - Tissu de qualité - Disponible en plusieurs tailles',
            'prix' => 35000,
            'prix_barre' => 45000,
            'pourcentage_reduction' => 22,
            'stock' => 50,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            ProductImage::create([
                'product_id' => $product3->id,
                'image_path' => 'products/costume-' . $i . '.jpg',
                'ordre' => $i,
            ]);
        }

        $this->command->info('✅ 3 produits de test créés avec 5 images chacun !');
    }
}