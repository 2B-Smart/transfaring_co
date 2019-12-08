<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('bill_date');
            $table->string('source_city');
            $table->foreign('source_city')->references('city_name')->on('cities');
            $table->string('destination_city');
            $table->foreign('destination_city')->references('city_name')->on('cities');
            $table->bigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->string('v_number');
            $table->foreign('v_number')->references('vehicle_number')->on('cars');
            $table->string('user_create');
            $table->string('user_last_update')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
