<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplorersTable extends Migration
{
    public function up()
    {
        Schema::create('explorers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('explorers');
    }
}
