<?php

namespace App\Http\Controllers;

use App\Services\CurrencyPairService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var CurrencyPairService
     */
    protected $currencyPairService;

    /**
     * Create a new controller instance.
     *
     * @param CurrencyPairService $currencyPairService
     */
    public function __construct(CurrencyPairService $currencyPairService)
    {
        $this->currencyPairService = $currencyPairService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pairs = $this->currencyPairService->getAllPairs();

        if ($pairs->count() > 0) {
            $mainPair = $pairs->first();
        } else {
            $mainPair = null;
        }

        return view('dashboard.home', ['pairs' => $pairs, 'mainPair' => $mainPair]);
    }

    /**
    * Add a currency pair to a given list type
    *
    */
    public function addPair(Request $request)
    {
        dd($request);
    }
}
