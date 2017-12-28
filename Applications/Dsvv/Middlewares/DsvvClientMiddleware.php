<?php

namespace Dsvv\Middlewares;

use Closure;
use Admin, System, Dsvv, Auth;

use Dsvv\Apps\Admin\Models\Frontpage;

class DsvvClientMiddleware
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
    	// if(is_null(System::user()) and System::isGuestCreated()):
    	// 	return redirect()->route('auth.login');
    	// endif;
        return $next($request);
    }
}
