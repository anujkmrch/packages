<?php

namespace Hpp\Middlewares;

use Closure;
use Admin, System, Hpp, Auth;

use Hpp\Apps\Admin\Models\Frontpage;

class HppClientMiddleware
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
