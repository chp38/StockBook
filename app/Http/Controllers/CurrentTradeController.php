<?php

namespace App\Http\Controllers;

use App\Services\Lists\ActiveListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CurrentTradeController extends Controller
{
    /**
     * @var ActiveListService
     */
    protected $currentService;

    /**
     * CurrentTradeController constructor.
     *
     * @param ActiveListService $currentService
     */
    public function __construct(ActiveListService $currentService)
    {
        $this->currentService  = $currentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trades = $this->currentService->getAll();

        return view('current.index', ['trades' => $trades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource - a current trade in progress
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trade = $this->currentService->getItem($id);
        $pipDiff = $this->currentService->getPipDifference($trade->detail->pair->name, $trade->detail->entry_price);

        return view('current.item', [
            'trade' => $trade,
            'pipDiff' => $pipDiff
        ]);
    }
}
