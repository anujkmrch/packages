<?php

namespace Cloud\Middlewares;

use Closure;
use Admin,System, Auth;

class CloudAuthenticate
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
        
        if(!System::can('can_access_cloud')):
            dd("You cannot access cloud");
        endif;
        return $next($request);;
    }
}
