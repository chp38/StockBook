<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TradeWatchlist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trade_details_id'
    ];

    /**
     * @var string $table
     */
    protected $table = 'current_watchlist';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function detail()
    {
        return $this->morphOne(TradeDetail::class, 'detailable');
    }
}
