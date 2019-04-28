<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('currency_pair_id')->nullable();//Fk - currency_pair
            $table->unsignedInteger('user_id')->nullable();//Fk - user_id
            $table->float('entry_price');//Entry_price
            $table->float('exit_price')->nullable();//Exit_price
            $table->integer('pip_difference')->nullable();//Pip_difference
            $table->integer('detailable_id')->unsigned();
            $table->string('detailable_type');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('trade_details', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('currency_pair_id')->references('id')->on('currency_pairs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_details_table');
    }
}
