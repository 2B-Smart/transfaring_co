<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sender')->unsigned();
            $table->foreign('sender')->references('id')->on('customers');
            $table->bigInteger('receiver')->unsigned();
            $table->foreign('receiver')->references('id')->on('customers');
            $table->string('source_city');
            $table->foreign('source_city')->references('city_name')->on('cities');
            $table->string('destination_city');
            $table->foreign('destination_city')->references('city_name')->on('cities');
            $table->date('receipts_date');
            $table->integer('number_of_packages');
            $table->string('package_type');
            $table->string('contents');
            $table->float('weight')->nullable();
            $table->string('size')->nullable();
            $table->string('marks')->nullable();
            $table->string('notes')->nullable();
            $table->float('prepaid')->nullable();
            $table->float('collect_from_receiver')->nullable();
            $table->float('prepaid_miscellaneous')->nullable();
            $table->float('trans_miscellaneous')->nullable();
            $table->float('remittances')->nullable();
            $table->string('remittances_paid')->nullable();
            $table->date('paid_date')->nullable();
            $table->string('discount')->nullable();
            $table->bigInteger('bill_id')->unsigned();
            $table->foreign('bill_id')->references('id')->on('bills');
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
        Schema::dropIfExists('receipts');
    }
}
