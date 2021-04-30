<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
        'order_id'
    ];

    /**
     * @var string $table
     */
    protected $table = 'gold_ea_tokens';
}
