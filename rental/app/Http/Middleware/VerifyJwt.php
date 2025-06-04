<?php


namespace App\Http\Middleware;

use App\Http\Logic\lib\JWTGenerator;
use Closure;
use Illuminate\Http\Request;

class VerifyJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTGenerator::decodeJWT($request->cookie('jwt'));
        }catch (\Exception $exception){
            return response('Not logged in',403);
        }
        return $next($request);
    }

}
