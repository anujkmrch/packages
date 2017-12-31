<?php

namespace Hpp\Middlewares;

use Closure;
use Admin,System, Auth;

use Hpp\Apps\Admin\Models\Frontpage;

class Hppify
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
        
        if (!Auth::guest() and !System::isGuestCreated()) {
            if(System::can('can_access_admin')):
                $this->build_admin_menu();
                $this->build_admin_quick_action_buttons();
                if($path = $request->input('redirect_to'))
                    return redirect($path);
            endif;
        }

        return $next($request);;
    }

    function build_admin_menu()
    {
        $menu=[
                "title"=> "Online Applications",
                "slug"=>"online-applications",
                "ordering"=> 0,
                "href"=>'/admin/orders',
                "parent_slug"=> 0,
            ];

        Admin::add_menu($menu,'sidebar');

    }

    function build_admin_quick_action_buttons()
    {
        foreach(Frontpage::$cells as $cell):
            Admin::add_quick_action_button($cell);
        endforeach;
    }
}
