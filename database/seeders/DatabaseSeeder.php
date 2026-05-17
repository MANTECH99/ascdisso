<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            AdminUserSeeder::class,
            // BannerSeeder::class,      // Décommenter quand créé
            // CategorySeeder::class,    // Décommenter quand créé
            // ProductSeeder::class,     // Décommenter quand créé
        ]);
    }
}
