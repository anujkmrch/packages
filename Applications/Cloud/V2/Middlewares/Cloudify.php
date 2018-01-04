<?php

namespace Cloud\Middlewares;

use Closure;
use Admin,System, Auth;

use Cloud\Apps\Admin\Models\Frontpage;

class Cloudify
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
        
        $menu=["title"=> "Cloud","slug"=>"users",'href'=>route('cloud.admin.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('cloud',['__base__'=>$menu]);

        $menu=["title"=> "Files","slug"=>"users",'href'=>route('cloud.admin.files'),"ordering"=> 11,];
        
        Admin::add_admin_menu('cloud/files',['__base__'=>$menu]);

        $menu=["title"=> "User","slug"=>"users",'href'=>route('cloud.admin.users'),"ordering"=> 0,];
        
        Admin::add_admin_menu('cloud/users',['__base__'=>$menu]);
        
        // $menu=["title"=> "Courses","slug"=>"users",'href'=>route('Cloud.admin.course.index'),"ordering"=> 12,];
        // Admin::add_admin_menu('university/courses',['__base__'=>$menu]);

        // $menu=["title"=> "Sessions","slug"=>"users",'href'=>route('Cloud.admin.session.index'),"ordering"=> 13,];
        // Admin::add_admin_menu('university/sessions',['__base__'=>$menu]);

        // $menu=["title"=> "Applicants","slug"=>"users",'href'=>route('Cloud.admin.applicant.index'),"ordering"=> 13,];
        // Admin::add_admin_menu('university/applicants',['__base__'=>$menu]);

    }

    function build_admin_quick_action_buttons()
    {
        // foreach(Frontpage::$cells as $cell):
        //     Admin::add_quick_action_button($cell);
        // endforeach;
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
