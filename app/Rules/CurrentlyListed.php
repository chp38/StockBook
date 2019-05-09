<?php

namespace App\Rules;

use App\Model\CurrentTrade;
use App\Model\TradeDetail;
use App\Model\TradeWatchlist;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CurrentlyListed implements Rule
{
    /**
     * The list we are adding to
     *
     * @var String
     */
    private $list;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(String $list)
    {
        $this->list = $list;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = Auth::user();

        $trades = TradeDetail::where('user_id', $user->id)
            ->where('currency_pair_id', $value)
            ->where('deleted_at', null)
            ->get();

        switch($this->list) {
            case 'watchlist':
                $model = TradeWatchlist::class;
                break;
            case 'trades':
                $model = CurrentTrade::class;
                break;
            default:
                $model = CurrentTrade::class;
                break;
        }

        foreach($trades as $trade) {
            if($trade->detailable instanceof $model) {
                return false;
            }
        }

        // TODO
        //  -   Should just return if $trade(singular) is null or not
        //      So that we can check that one currency pair is only
        //      active in one list at a time

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Currency Pair is already being traded or watched!';
    }
}
