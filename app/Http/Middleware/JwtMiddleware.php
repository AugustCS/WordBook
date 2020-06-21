<?php

namespace App\Http\Middleware;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Http\Middleware\Exception;

class JwtMiddleware
{

    public function handle($request, Closure $next)
    {
        // try {
        //     $user = JWTAuth::parseToken()->authenticate();
        // }catch (Exception $e) {
        //     if ($e instanceof TokenInvalidException){
        //         return response()->json(['status' => 'Token is Invalid']);
        //     }else if ($e instanceof TokenExpiredException){
        //         return response()->json(['status' => 'Token is Expired']);
        //     }else{
        //         return response()->json(['status' => 'Authorization Token not found']);
        //     }
        // }

        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch(TokenInvalidException $e){
            return response()->json(['status' => 'Token Inválido']);
        }catch(TokenExpiredException $e){
            return response()->json(['status' => 'Token Expiró']);
        }catch(JWTException $e){
            return response()->json(['status' => 'Authorization Token no encontrado']);
        }

        return $next($request);
    }
}
