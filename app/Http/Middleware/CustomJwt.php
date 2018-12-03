<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class CustomJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::toUser($request->get('token'));
        } catch (Exception $e) {
            //token non è stato identificato
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response(503)->json([
                    'error' => 'Token is invalid'
                ]);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response(503)->json([
                    'error' => 'Token is expired'
                ]);
            }

            //errore generico
            return response(503)->json([
                    'error' => 'Please contact support'
                ]);
        }
        return $next($request);
    }
}
