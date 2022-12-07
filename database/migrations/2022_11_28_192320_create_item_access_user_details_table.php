<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('item_access_user_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('serie')->nullable();
            $table->string('cne_code')->nullable();
            $table->string('processor')->nullable();
            $table->string('ram')->nullable();
            $table->string('disk')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('type')->nullable();
            $table->string('state')->nullable();
            $table->unsignedInteger('amount');
            $table->foreignId('item_id')->constrained();
            $table->foreignId('item_access_user_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_access_user_details');
    }
};
