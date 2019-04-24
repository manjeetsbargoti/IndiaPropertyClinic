<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id')->unsigned();
            $table->boolean('gym')->nullable()->default('0');
            $table->boolean('club_house')->nullable()->default('0');
            $table->boolean('play_area')->nullable()->default('0');
            $table->boolean('water_supply')->nullable()->default('0');
            $table->boolean('geyser')->nullable()->default('0');
            $table->boolean('visitor_arking')->nullable()->default('0');
            $table->boolean('garden')->nullable()->default('0');
            $table->boolean('waste_disposal')->nullable()->default('0');
            $table->boolean('power_backup')->nullable()->default('0');
            $table->boolean('swimming_pool')->nullable()->default('0');
            $table->boolean('water_storage')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenities');
    }
}
