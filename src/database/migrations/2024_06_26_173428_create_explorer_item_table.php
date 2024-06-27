<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplorerItemTable extends Migration
{
    public function up()
    {
        Schema::create('explorer_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('explorer_id')->nullable()->constrained();
            $table->foreignId('item_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('explorer_item');
    }
}
