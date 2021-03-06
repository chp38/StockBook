<?php

namespace App\Http\Controllers;

use App\Services\Lists\WatchlistService;
use Illuminate\Http\Request;

class TradeWatchlistController extends Controller
{
    /**
     * @var WatchlistService
     */
    protected $watchlistService;

    /**
     * TradeWatchlistController constructor.
     *
     * @param WatchlistService $service
     */
    public function __construct(WatchlistService $service)
    {
        $this->watchlistService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $watchlist = $this->watchlistService->getAll();

        return view('watchlist.index', ['watchlist' => $watchlist]);
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
        $watchlistItem = $this->watchlistService->getWatchlistItem($id);

        return view('watchlist.item', ['watchlistItem' => $watchlistItem]);
    }
}
