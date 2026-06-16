<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFraisToCommandesTable extends Migration
{
    public function up()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->decimal('frais', 10, 2)->default(0)->after('sous_total');
        });
    }

    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('frais');
        });
    }
}