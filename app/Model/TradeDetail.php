<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradeDetail extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Model\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pair() {
        return $this->belongsTo('App\Model\CurrencyPair', 'currency_pair_id');
    }
}
