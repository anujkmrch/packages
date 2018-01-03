<?php

namespace Dsvv\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Dsvv\Apps\Admin\Models\Frontpage;

use Dsvv\Models\CourseSession;
use Dsvv\Models\Course;

class SessionController extends Controller
{
    public function index(Request $request)
    {	
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
        \Admin::add_to_toolbar(['name'=>'Create session','href'=>route('dsvv.admin.session.create')]);

    	$courses = CourseSession::with('courses')->get();
       	return view('DsvvView::admin.session.index',compact('courses'));
    }
    
    public function single(Request $request, $id)
    {
    	\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

    	\Admin::add_to_toolbar(['name'=>'All Sessions','href'=>route('dsvv.admin.session.index')]);

        \Admin::add_to_toolbar(['name'=>'Create Session','href'=>route('dsvv.admin.session.create')]);

    	if($course = CourseSession::with('courses')->find($id))
    	{
    		return view("DsvvView::admin.session.single",compact('course'));
    	}
    }

    public function doSingle(Request $request, $id)
    {
        if($course = CourseSession::with('courses')->find($id))
        {
            $keys = array_keys(config('dsvv.session'));
            $course->setSessionData($request->only($keys));
            $course->save();
            return redirect()->route('dsvv.admin.session.single',['id'=>$course->id]);
        }
    }

    public function create(Request $request)
    {
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'All sesion','href'=>route('dsvv.admin.session.index')]);

        \Admin::add_to_toolbar(['name'=>'Create course','href'=>route('dsvv.admin.course.create')]);

        $course = new CourseSession;
        // dd($course->formElements(true));

        return view("DsvvView::admin.session.create",compact('course'));
    }

    public function doCreate(Request $request)
    {
        $keys = array_keys(config('dsvv.session'));
        $course = new CourseSession();
        $course->setSessionData($request->only($keys));
        $course->save();
        return redirect()->route('dsvv.admin.session.single',['id'=>$course->id]);
    }
}
