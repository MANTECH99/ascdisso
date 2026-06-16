
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_match');
            $table->string('competition');
            $table->string('equipe_domicile');
            $table->string('equipe_exterieur');
            $table->integer('score_domicile')->nullable();
            $table->integer('score_exterieur')->nullable();
            $table->enum('statut', ['a_venir', 'en_cours', 'termine'])->default('a_venir');
            $table->integer('minute')->nullable();
            $table->string('stade')->nullable();
            $table->json('buteurs_domicile')->nullable();
            $table->json('buteurs_exterieur')->nullable();
            $table->string('saison')->default('2025-2026');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matchs');
    }
};