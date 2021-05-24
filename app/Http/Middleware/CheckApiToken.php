<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
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
        $auth_token = $request->header('Authorization');

        if(empty($auth_token)) {
            return response()->json([
                'success' => false,
                'error' => 'Api token missed'
            ]);
        }

        $api_token = substr($auth_token, 7);
        $user = User::where('api_token', $api_token)->first();

        if(!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Wrong Api token'
            ]);
        }
        return $next($request);
    }
}
