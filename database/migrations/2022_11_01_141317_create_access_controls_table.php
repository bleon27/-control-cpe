<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('access_controls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('access_user_id')->constrained();
            $table->dateTime('entry_date', $precision = 0);
            $table->dateTime('departure_date', $precision = 0)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('access_controls');
    }
};
