<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use JWTAuthException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = null;

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response(403)->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response(403)->json([
                    'response' => 'error',
                    'message' => 'failrd_to_create_token',
                ]);
        }

        return response()->json([
                    'response' => 'success',
                    'result' => $token,
                ]);
    }
}
