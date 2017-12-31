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
                $this->build_admin_dashboard();
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
        ];

        Admin::add_admin_menu('logout',['__base__'=>$menu]);
        $menu=[
            "title"=> "Applications",
            "slug"=>"applications",
            "href"=>'/admin/applications',
            "ordering"=> 0,
            'permission' => 'manage_options',
        ];

        Admin::add_admin_menu('applications',['__base__'=>$menu]);
        
        $menu=[
            "title"=> "Client",
            "slug"=>"client",
            'href'=>"/admin/client",
            "ordering"=> 0,
        ];

        Admin::add_admin_menu('client',['__base__'=>$menu]);

        $menu=[
            "title"=> "Stores",
            "slug"=>"client/stores",
            "href"=>'//sellers.webodeci.com',
            "ordering"=> 0,
        ];
        Admin::add_admin_menu('client/sellers',['__base__'=>$menu]);

        $menu=[
            "title"=> "Admins",
            "slug"=>"client/admin",
            "href"=>'/admin/client/administrators',
            "ordering"=> 2,
        ];
        Admin::add_admin_menu('client/sellers/admin',['__base__'=>$menu]);

        $menu=[
            "title"=> "Dashboard",
            "slug"=>"dashboard",
            "href"=>'/admin',
            "ordering"=> -2,
        ];
        Admin::add_admin_menu('/admin',['__base__'=>$menu]);
        $menu=[
            "title"=> "Settings",
            "slug"=>"settings",
            "ordering"=> 1,
            "href"=>'/admin/settings',
        ];
        Admin::add_admin_menu('settings',['__base__'=>$menu]);

        $menu=[
            "title"=> "Appearance",
            "slug"=>"appearance",
            "ordering"=> 1,
            "href"=>'/admin/appearance',
        ];
        Admin::add_admin_menu('appearance',['__base__'=>$menu]);
    }

    function build_admin_quick_action_buttons()
    {
        foreach(Frontpage::$cells as $cell):
            Admin::add_quick_action_button($cell);
        endforeach;
    }

    function build_admin_dashboard()
    {
        $dashboard = [
            "title"=> "Dashboard User Data",
            "slug"=>"users",
            "callback"=> 'total_registered_users',
            'ordering' => -23,
        ];

        Admin::add_admin_dashboard($dashboard);

        $dashboard = [
            "title"=> "Total Visits",
            "slug"=>"visits",
            "callback"=> 'tracker_data',
            'ordering' => 0,
        ];

        Admin::add_admin_dashboard($dashboard);
    }
}
