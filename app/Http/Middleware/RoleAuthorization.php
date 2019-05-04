<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Http\Resources\userResourse;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        try {
            //Access token from the request        
            $token = JWTAuth::parseToken();
    
            //Try authenticating user       
            $user = $token->authenticate();
        } catch (TokenExpiredException $e) {
    
            //Thrown if token has expired        
            return $this->unauthorized('Your token has expired. Please, login again.');
    
        } catch (TokenInvalidException $e) {
    
            //Thrown if token invalid
            return $this->unauthorized('Your token is invalid. Please, login again.');
    
        }catch (JWTException $e) {
    
            //Thrown if token was not found in the request.
            return $this->unauthorized('Please, attach a Bearer Token to your request');
        }
        if (!$request->user()->authorizeRoles($roles)){
            return $this->unauthorized();
        }
            return $next($request);
    } 
   
    private function unauthorized($message = null){
        return response()->json([
            'message' => $message ? $message : 'You are unauthorized to access this resource',
            'success' => false
        ], 401);
    }
}
