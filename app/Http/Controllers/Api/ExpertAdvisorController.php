<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpertAdvisorController extends Controller
{
    private $tokens = [
        'Charles-token',
        'edward'
    ];

    /**
     * @param Request $request
     * 
     * @return Json Response
     */
    public function auth(Request $request)
    {
        $token = $request->input('token');

        return response()->json([
            'valid' => in_array($token, $this->tokens)
        ]);
    }
}
