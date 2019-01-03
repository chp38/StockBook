<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentWatchlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_watchlist', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();//Deleted_at
            //watch_time??
            $table->float('high_stop_watch')->nullable();//high_stop
            $table->float('low_stop_watch')->nullable();//Low_stop
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
        Schema::dropIfExists('current_watchlist');
    }
}
