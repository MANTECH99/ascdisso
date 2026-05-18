<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nom',
        'slug',
        'image',
        'ordre',
    ];


        protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->slug = $category->generateUniqueSlug($category->nom);
        });
        
        static::updating(function ($category) {
            if ($category->isDirty('nom')) {
                $category->slug = $category->generateUniqueSlug($category->nom);
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-category.png');
    }
}