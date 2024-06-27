<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplorerLocationsHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('explorer_locations_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('explorer_id')->constrained()->onDelete('cascade');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('explorer_locations_history');
    }
}

