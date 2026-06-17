<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->dateTime('date_match')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->dateTime('date_match')->nullable(false)->change();
        });
    }
};