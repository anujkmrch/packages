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
        // if(!System::can('can_access_cloud')):
        // 	if (!Auth::guest() and !System::isGuestCreated()) {
        //         dd("You cannot access");
        // 	}
        // 	else {
        // 		$request->session()->flash('alert-danger', 'You need to login');
        // 		if($path = trim($request->path(),'/'))
        // 			return redirect(route('auth.login',['redirect_to' => $path]));
        // 		return redirect()->route('auth.login');
        // 	}
        // endif;

        return $next($request);;
    }
}
