<?php

namespace App\Rules;

use App\Model\TradeDetail;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CurrentlyListed implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $trade = TradeDetail::where('user_id', $user->id)
            ->where('currency_pair_id', $value)
            ->first();


        return !$trade instanceof TradeDetail;
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
