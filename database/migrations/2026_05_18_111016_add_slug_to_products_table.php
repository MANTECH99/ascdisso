<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        // 1. Ajouter la colonne sans unique d'abord
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('nom');
        });
        
        // 2. Générer les slugs pour tous les produits
        $products = \App\Models\Product::all();
        foreach ($products as $product) {
            $slug = Str::slug($product->nom);
            
            // Vérifier les doublons
            $count = 1;
            $originalSlug = $slug;
            while (\App\Models\Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            $product->slug = $slug;
            $product->save();
        }
        
        // 3. Rendre unique après avoir rempli
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};