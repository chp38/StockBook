<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradeWatchlist extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'current_watchlist';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detail() {
        return $this->belongsTo('App\Model\TradeDetail', 'trade_details_id');
    }
}
