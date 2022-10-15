<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        if (env('APP_ENV') !== 'local'){
            $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT,PATCH,DELETE');
            header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Accept, Cookie, Referrer-Policy, Origin');
        }

        return $next($request);
    }
}
