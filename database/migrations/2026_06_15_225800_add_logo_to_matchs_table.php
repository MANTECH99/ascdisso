<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->string('logo_domicile')->nullable()->after('equipe_domicile');
            $table->string('logo_exterieur')->nullable()->after('equipe_exterieur');
        });
    }

    public function down()
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->dropColumn(['logo_domicile', 'logo_exterieur']);
        });
    }
};