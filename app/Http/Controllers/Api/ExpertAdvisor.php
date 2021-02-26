<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ExpertAdvisor extends Controller
{
    private $tokens = [
        'Charles',
        'Edward'
    ];

    /**
     * @param Request $request
     * 
     * @return Json Response
     */
    public function auth(Request $request)
    {
        $token = $request->input('token');

        return in_array($token);

        return response()->json([
            'valid' => in_array($token, $this->tokens)
        ]);
    }
}
