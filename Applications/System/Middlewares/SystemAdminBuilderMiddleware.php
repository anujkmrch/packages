<?php

namespace System\Middlewares;

use Closure;
use System,Auth,Admin;

use System\Apps\Admin\Models\Frontpage;

class SystemAdminBuilderMiddleware
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

        return $next($request);
        // return $next($request);
    }

    function build_admin_menu()
    {
        $menu=[
            "title"=> "Logout",
            "slug"=>"logout",
            "ordering"=> 20,
            "href"=>'/logout',
            "parent_slug"=> 0,
        ];
        Admin::add_menu($menu,'sidebar');
        
        $menu=[
            "title"=> "Applications",
            "slug"=>"applications",
            "href"=>'/applications',
            "ordering"=> 0,
            "parent_slug"=> 0,
        ];
        Admin::add_menu($menu,'sidebar');
        $menu=[
            "title"=> "Website",
            "slug"=>"client",
            'href'=>"/client",
            "ordering"=> 0,
            "parent_slug"=> "applications",
        ];
        Admin::add_menu($menu,'sidebar');
        $menu=[
            "title"=> "Sellers",
            "slug"=>"sellers",
            "href"=>'://sellers.webodeci.com',
            "ordering"=> 0,
           "parent_slug"=> "applications",
        ];
        Admin::add_menu($menu,'sidebar');
        $menu=[
            "title"=> "Dashboard",
            "slug"=>"dashboard",
            "href"=>'/admin',
            "ordering"=> 0,
            "parent_slug"=> 0,
        ];
        Admin::add_menu($menu,'sidebar');
        $menu=[
            "title"=> "Settings",
            "slug"=>"settings",
            "ordering"=> 0,
            "href"=>'/admin/settings',
            "parent_slug"=> 0,
        ];
        Admin::add_menu($menu,'sidebar');

        $menu=[
            "title"=> "Appearance",
            "slug"=>"appearance",
            "ordering"=> 0,
            "href"=>'/admin/appearance',
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
