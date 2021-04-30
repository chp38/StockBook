<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tokens;
use Symfony\Component\CssSelector\Parser\Token;

class ExpertAdvisorController extends Controller
{
    /**
     * @param Request $request
     * 
     * @return Json Response
     */
    public function auth(Request $request)
    {
        $token = $request->input('token');

        $found = Tokens::where('token', $token)->get();

        return response()->json([
            'valid' => $found->count() == 1 ? true : false
        ]);
    }

    /**
     * Index function, show all tokens and the add form.
     */
    public function index()
    {
        $tokens = Tokens::all();
        return view('tokens.index', ['tokens' => $tokens]);
    }

    /**
     * Store a new token.
     * 
     * @param Request $request
     */
    public function store(Request $request)
    {
        $token = new Tokens;

        $token->order_id = $request->get('order_id');
        $token->token = $request->get('token');
        $token->email = $request->get('email');

        $token->save();

        $tokens = Tokens::all();
        return view('tokens.index', ['tokens' => $tokens]);
    }

    /**
     * Delete a token record.
     * 
     * @param Request $request
     * @param int $id
     */
    public function destroy(Request $request, int $id)
    {
        $flight = Tokens::find($id);

        $flight->delete();

        $tokens = Tokens::all();
        return redirect()->route('manage-tokens');
    }
}
