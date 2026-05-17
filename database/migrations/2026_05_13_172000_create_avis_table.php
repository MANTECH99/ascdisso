<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('note');
            $table->text('commentaire')->nullable();
            $table->timestamps();
            
            // Contrainte CHECK pour la note entre 1 et 5
            $table->unsignedTinyInteger('note')->default(5)->change();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avis');
    }
};