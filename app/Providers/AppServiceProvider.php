<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

    if (app()->environment('production') || str_contains(request()->getHost(), 'billeteriexpress.com')) {
        URL::forceScheme('https');
    }

                Validator::extend('senegal_phone', function ($attribute, $value, $parameters, $validator) {
            // Accepte formats: 77 234 56 87 ou 772345687
            $cleaned = preg_replace('/\s+/', '', $value);
            return preg_match('/^(77|78|76|70|75|33)\d{7}$/', $cleaned);
        }, 'Le numéro de téléphone sénégalais n\'est pas valide.');
    
    }
}
