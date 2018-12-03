<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Http\Controllers\Controller;

class MeController extends Controller
{
    public function __invoke()
    {
        $user = JWTAuth::toUser(request('token'));

        return response()->json([
                    'response' => 'success',
                    'result' => $user,
                ]);
    }
}
