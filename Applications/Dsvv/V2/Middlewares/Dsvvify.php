<?php

namespace Dsvv\Middlewares;

use Closure;
use Admin,System, Auth;

use Dsvv\Apps\Admin\Models\Frontpage;

class Dsvvify
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

        return $next($request);;
    }

    function build_admin_menu()
    {
        
        $menu=["title"=> "University","slug"=>"users",'href'=>route('dsvv.admin.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('university',['__base__'=>$menu]);

        $menu=["title"=> "Applications","slug"=>"users",'href'=>route('dsvv.admin.application.index'),"ordering"=> 11,];
        Admin::add_admin_menu('university/applications',['__base__'=>$menu]);

        $menu=["title"=> "Courses","slug"=>"users",'href'=>route('dsvv.admin.course.index'),"ordering"=> 12,];
        Admin::add_admin_menu('university/courses',['__base__'=>$menu]);

        $menu=["title"=> "Sessions","slug"=>"users",'href'=>route('dsvv.admin.session.index'),"ordering"=> 13,];
        Admin::add_admin_menu('university/sessions',['__base__'=>$menu]);

        $menu=["title"=> "Applicants","slug"=>"users",'href'=>route('dsvv.admin.applicant.index'),"ordering"=> 13,];
        Admin::add_admin_menu('university/applicants',['__base__'=>$menu]);

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
            "title"=> "Application Status",
            "slug"=>"application status",
            "callback"=> 'applications_status',
            'ordering' => -22,
        ];
        Admin::add_admin_dashboard($dashboard);
    }
}
