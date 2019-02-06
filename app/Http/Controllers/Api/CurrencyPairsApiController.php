<?php

namespace App\Http\Controllers\API;

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
}
