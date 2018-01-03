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
    }

    function build_admin_menu()
    {
        //
        //user menu
        //
        $menu=["title"=> Auth::user()->name,"slug"=>"username","ordering"=> 0,
            "href"=>'/admin/my-profile',];
        Admin::add_admin_menu('user',['__base__'=>$menu],'usermenu');

        $menu=["title"=>"My Profile","slug"=>"my-profile","href"=>'/admin/my-profile',"ordering"=> 0,'permission'=>'manage_options',];
        Admin::add_admin_menu('user/profile',['__base__'=>$menu],'usermenu');
        
        $menu=["title"=>"Logout","slug"=>"logout","ordering"=> 20,           "href"=>'/logout',];
        Admin::add_admin_menu('user/logout',['__base__'=>$menu],'usermenu');

        //
        //
        //sideabar menu
        //
        //
        $menu=["title"=>"Dashboard","slug"=>"dashboard","href"=>'/admin',
            "ordering"=>-1,];
        Admin::add_admin_menu('/admin',['__base__'=>$menu]);
        
        // Sidebar user menu
        $menu=["title"=> "Users","slug"=>"users",'href'=>"/admin/users",
            "ordering"=> 0,];
        Admin::add_admin_menu('users',['__base__'=>$menu]);

        // $menu=["title"=> "All users","slug"=>"users",'href'=>"/admin/users/all","ordering"=> 0,];
        // Admin::add_admin_menu('users/all',['__base__'=>$menu]);

        // $menu=["title"=> "Create new","slug"=>"users",'href'=>"/admin/user/new","ordering"=> 0,];
        // Admin::add_admin_menu('users/new',['__base__'=>$menu]);

        // Sidebar Access control
        $menu=["title"=> "Access Control","slug"=>"users",'href'=>"/admin/access","ordering"=> 1,];
        Admin::add_admin_menu('access',['__base__'=>$menu]);

        // Sidebar Menus entries
        $menu=["title"=> "Menus","slug"=>"menus",'href'=>"/admin/menus",
            "ordering"=> 1,];
        Admin::add_admin_menu('menus',['__base__'=>$menu]);

        // Sidebar Widgets entries
        $menu=["title"=> "Widgets","slug"=>"menus",'href'=>"/admin/widgets",
            "ordering"=> 1,];
        Admin::add_admin_menu('widgets',['__base__'=>$menu]);

        // Sidebar Plugins entries
        $menu=["title"=> "Plugins","slug"=>"menus",'href'=>"/admin/plugins",
            "ordering"=> 2,];
        Admin::add_admin_menu('plugin',['__base__'=>$menu]);
    }

    function build_admin_quick_action_buttons()
    {
        foreach(Frontpage::$cells as $cell):
            Admin::add_quick_action_button($cell);
        endforeach;
    }

    function build_admin_dashboard()
    {
        $dashboard=["title"=> "Dashboard User Data","slug"=>"users","callback"=>'total_registered_users','ordering' => 0,];
        Admin::add_admin_dashboard($dashboard);

        $dashboard=["title"=>"Total Visits","slug"=>"visits","callback"=>'tracker_data','ordering'=>0,];
        Admin::add_admin_dashboard($dashboard);

        $dashboard=["title"=>"Dashboard User Data","slug"=>"users","callback"=>'total_registered_users','ordering'=>0,];
        Admin::add_admin_dashboard($dashboard);

    }
}