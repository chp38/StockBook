<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricalTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historical_trades', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();
            $table->unsignedInteger('current_trades_id')->nullable();
            $table->foreign('current_trades_id')->references('id')->on('current_trades');
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
        Schema::dropIfExists('historical_trades');
    }
}
