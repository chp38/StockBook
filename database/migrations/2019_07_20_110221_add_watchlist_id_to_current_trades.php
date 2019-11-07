<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWatchlistIdToCurrentTrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('current_trades', function (Blueprint $table) {
            $table->unsignedInteger('watchlist_id')->nullable();
            $table->foreign('watchlist_id')->references('id')->on('current_watchlist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('current_trades', function (Blueprint $table) {
            //
        });
    }
}
