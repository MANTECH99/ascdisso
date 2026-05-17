<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'prenom' => 'Admin',
            'nom' => 'ASC Disso',
            'email' => 'admin@ascdisso.sn',
            'telephone' => '77 000 00 00',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'adresse' => 'Siège ASC Disso, Dakar, Sénégal',
        ]);

        // Message de confirmation
        $this->command->info('✅ Administrateur créé avec succès !');
        $this->command->info('📧 Email : admin@ascdisso.sn');
        $this->command->info('🔑 Mot de passe : admin123');
        $this->command->info('📱 Téléphone : 77 000 00 00');
    }
}