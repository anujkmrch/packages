<?php

namespace Dsvv\Middlewares;

use Closure;
use Admin;

use Dsvv\Apps\Admin\Models\Frontpage;

class DsvvAdminMiddleware
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
        $this->build_admin_menu();
        $this->build_admin_quick_action_buttons();

        return $next($request);
    }

    function build_admin_menu()
    {
        
    }

    function build_admin_quick_action_buttons()
    {
        
    }
}
