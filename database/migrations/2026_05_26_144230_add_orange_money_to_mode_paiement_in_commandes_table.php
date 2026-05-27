<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE commandes MODIFY COLUMN mode_paiement ENUM('livraison', 'wave', 'orange_money') DEFAULT 'livraison'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE commandes MODIFY COLUMN mode_paiement ENUM('livraison', 'wave') DEFAULT 'livraison'");
    }
};