<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email', 255);
            $table->string('phone');
            $table->string('loan_amount');
            $table->string('loan_tenure');
            $table->string('age');
            $table->string('property_identify');
            $table->string('property_city');
            $table->string('property_cost');
            $table->string('occupation');
            $table->string('total_emi');
            $table->string('accept_condition');
            $table->string('resolved')->default('0');
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
        Schema::dropIfExists('home_loans');
    }
}
