<?php

namespace App\Http\Controllers;

use App\Rules\CurrentlyListed;
use App\Services\CurrencyPairService;
use App\Services\Lists\ListService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var CurrencyPairService
     */
    protected $currencyPairService;

    /**
     * @var ListService
     */
    protected $listService;

    /**
     * Create a new controller instance.
     *
     * @param CurrencyPairService $currencyPairService
     * @param ListService         $listService
     */
    public function __construct(CurrencyPairService $currencyPairService, ListService $listService)
    {
        $this->currencyPairService = $currencyPairService;
        $this->listService = $listService;
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
     * Add a currency pair to a given list type - ensure it doesn't already exist in the list
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPair(Request $request)
    {
        $validator = $request->validate([
            'pair_id' => ['required', 'string', new CurrentlyListed],
            'list'    => 'required',
        ]);

        $detail = $this->listService->addFromHomepage($request->list, $request->pair_id);

        if ($detail != null) {
            return redirect()->back()->with('success', "Successfully added to $request->list");
        }

        return redirect()->back()->with('error', "Something went wrong adding to list!");
    }
}
