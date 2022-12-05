<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('item_access_users', function (Blueprint $table) {
            $table->id();
            $table->string('status', 20);
            $table->string('reason')->nullable();
            $table->foreignId('access_user_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->timestamp('assigned_at', $precision = 0)->nullable();
            $table->timestamp('returned_at', $precision = 0)->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_access_users');
    }
};
