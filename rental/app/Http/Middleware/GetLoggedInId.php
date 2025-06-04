<?php


namespace App\Http\Middleware;


use App\Http\Logic\lib\JWTGenerator;
use Closure;
use Illuminate\Http\Request;

class GetLoggedInId
{

    public function handle(Request $request, Closure $next){
;
        $jwt = $request->cookie('jwt');
        if($jwt!==null) {
            $jwt_array = (array)JWTGenerator::decodeJWT($jwt);
            $id = $jwt_array['id'];
            $request->request->add(['user_id' => intval($id)]);
        }else{
            $request->user_id = null;
        }
        return $next($request);

    }

}
