<?php

namespace System\Middlewares;

use Closure;
use System,Auth,Admin;

use System\Models\Role;

use System\Apps\Admin\Models\Frontpage;

class SystemAdminMiddleware
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
        if($request->route()->getPrefix() === '/admin'):
            if (!Auth::guest() and !System::isGuestCreated()) {
                if(System::can('can_access_admin')):
                    if($path = $request->input('redirect_to'))
                        return redirect($path);
                    return $next($request);
                else:
                   return redirect('/');
                endif;
            }
            $path = 'admin';
            if($request->has('redirect_to'))
                $path = $request->input('redirect_to');
            if(request()->getSchemeAndHttpHost() === config('app.url')){
                $path = request()->path();
            }
            return redirect(route('auth.login',['redirect_to' => $path]));
        endif;
        return $next($request);
    }

    function build_admin_menu()
    {
        $menu = [
            'id'    => 'my-item',
            'title' => 'My Item',
            'href'  => '#',
            'meta'  => array(
                'title' => 'My Item',
            )
        ];
        
        Admin::add_menu($menu);
        
        Admin::add_menu($menu);
        
        Admin::add_menu($menu);
        
        Admin::add_menu($menu);
        
        Admin::add_menu($menu);
        
        Admin::add_menu($menu);
        
        Admin::add_menu($menu);
    }

    function build_admin_quick_action_buttons()
    {
        foreach(Frontpage::$cells as $cell):
            Admin::add_quick_action_button($cell);
        endforeach;
    }
}
