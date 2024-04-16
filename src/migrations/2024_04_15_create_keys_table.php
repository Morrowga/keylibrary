<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->uuid('uuid')->nullable()->unique();
            $table->string('collection_name')->default('key_collections');
            $table->string('timestamp');
            $table->string('public_key_path');
            $table->string('private_key_path');


            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_keys');
    }
};
