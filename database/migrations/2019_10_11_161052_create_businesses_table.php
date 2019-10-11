<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name')->nullable();
            $table->string('business_type')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_phone')->nullable();
            $table->text('business_description')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_phone')->nullable();
            $table->string('business_website')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('locality')->nullable();
            $table->string('zipcode')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
