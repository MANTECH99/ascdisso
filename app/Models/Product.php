<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Add this import

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'nom',
        'slug',
        'description',
        'prix',
        'prix_barre',
        'pourcentage_reduction',
        'stock',
        'boutique_officielle',
    ];


        protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = $product->generateUniqueSlug($product->nom);
        });
        
        static::updating(function ($product) {
            if ($product->isDirty('nom')) {
                $product->slug = $product->generateUniqueSlug($product->nom);
            }
        });
    }

    public function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        
        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        return $slug;
    }

    // Route binding par slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'boutique_officielle' => 'boolean',
        'prix' => 'decimal:2',
        'prix_barre' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('ordre');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function getFirstImageUrlAttribute()
    {
        $firstImage = $this->images()->first();
        return $firstImage ? asset('storage/' . $firstImage->image_path) : asset('images/default-product.png');
    }

    public function getAverageRatingAttribute()
    {
        return $this->avis()->avg('note') ?? 0;
    }

    public function getReductionAttribute()
    {
        if ($this->prix_barre && $this->prix_barre > $this->prix) {
            return round((($this->prix_barre - $this->prix) / $this->prix_barre) * 100);
        }
        return $this->pourcentage_reduction;
    }
}