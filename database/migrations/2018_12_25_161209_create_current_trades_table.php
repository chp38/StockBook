<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_trades', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();//Deleted_at
            $table->float('stop_loss')->nullable();//Stop_loss
            $table->float('take_profit')->nullable();//Take_profit
            $table->boolean('trailing_trade')->default(false);//Trailing_trade
            $table->unsignedInteger('trade_details_id');//Trade_details_id
            $table->foreign('trade_details_id')->references('id')->on('trade_details')->onDelete('cascade');
            $table->boolean('active')->default(true);//Active
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
        Schema::dropIfExists('current_trades');
    }
}
