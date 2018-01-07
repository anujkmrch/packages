<?php

namespace System\Middlewares;

use Closure;
use System;
class SystemApiGuestUserMiddleware
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
        if(!System::checkUserObject()){
            System::loginGuestUser();
        }
        
        // System::checkGuest();
        
        System::_initialize(true);

        return $next($request);
    }
}
