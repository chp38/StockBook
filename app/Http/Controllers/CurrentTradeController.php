<?php

namespace App\Http\Controllers;

use App\Services\Lists\ActiveListService;
use Illuminate\Http\Request;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trade = $this->currentService->getItem($id);

        return view('current.item', ['trade' => $trade]);
    }
}
