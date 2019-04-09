<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_queries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usertype')->NULL;
            $table->string('name')->NULL;
            $table->string('email', 128)->NULL;
            $table->string('phone')->NULL;
            $table->string('accept_condition');
            $table->boolean('status')->default('0')->NULL;
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
        Schema::dropIfExists('property_queries');
    }
}
