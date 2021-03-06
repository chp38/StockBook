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
