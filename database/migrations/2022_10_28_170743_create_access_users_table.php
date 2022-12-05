<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(
            'access_users', function (Blueprint $table) {
                $table->id();
                //$table->dateTime('date', $precision = 0);
                //$table->string('first_name');
                //$table->string('second_name');
                $table->string('names');
                $table->string('surnames');
                //$table->string('full_names');
                //$table->string('second_surname');
                $table->string('document_number')->nullable();
                $table->string('ci');
                $table->string('unit');
                $table->string('position');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('access_users');
    }
};
