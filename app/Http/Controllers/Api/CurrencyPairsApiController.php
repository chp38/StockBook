<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CurrencyPairService;

class CurrencyPairsApiController extends Controller
{
    /**
    * @var CurrencyPairService
    */
    private $service;

    public function __construct(CurrencyPairService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = $this->service->getPairPrice($id);

        if ($price) {
            return response()->json([
                'price' => $price,
                'error' => false
            ]);
        }

        return response()->json([
            'price' => null,
            'error' => true,
            'description' =>
                'Pair not found'
        ]);
    }

    /**
     * Get the current intra-day prices of a pair
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPairPrices($id)
    {
        $intraDay = $this->service->getPairPrices($id);

        return response()->json([
            'prices' => $intraDay['data'],
        ]);
    }
}
