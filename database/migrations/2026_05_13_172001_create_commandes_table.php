<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nom_complet');
            $table->text('adresse');
            $table->string('telephone', 20);
            $table->enum('mode_paiement', ['livraison', 'wave'])->default('livraison');
            $table->string('mode_livraison', 50)->default('Domicile');
            $table->enum('statut', ['en_attente', 'validee', 'livree', 'annulee'])->default('en_attente');
            $table->enum('statut_paiement', ['non_paye', 'paye'])->default('non_paye');
            $table->decimal('sous_total', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};