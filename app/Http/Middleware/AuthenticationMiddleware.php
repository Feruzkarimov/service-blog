<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class AuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Check for authentication
        $this->isValid($request);
        return $next($request);
    }

    public function isValid(Request $request)
    {
        $token = $request->bearerToken();
        $decryptedToken = decrypt($token);

        if (!$request->hasHeader('Authorization')) {
            throw new UnauthorizedException('Header Of The Request Does Not Exist.');
        }

       if ($decryptedToken['user_id'] == null) {
            throw new UnauthorizedException('User Id Does Not Exist.');
       }

       if ($decryptedToken['expires_at']->lt(now())){
            throw new UnauthorizedException('Token Is Expired.');
       }
    }
}
