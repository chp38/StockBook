<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HistoricalTrade extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'historical_trades';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trade() {
        return $this->belongsTo('App\Model\CurrentTrade', 'current_trades_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function detail()
    {
        return $this->morphOne(TradeDetail::class, 'detailable');
    }
}
