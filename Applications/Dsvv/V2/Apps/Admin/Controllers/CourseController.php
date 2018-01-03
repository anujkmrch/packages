<?php

namespace Dsvv\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Dsvv\Apps\Admin\Models\Frontpage;

use Dsvv\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {	
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
        \Admin::add_to_toolbar(['name'=>'Create course','href'=>route('dsvv.admin.course.create')]);
    	$courses = Course::with('session')->get();
       	return view('DsvvView::admin.course.index',compact('courses'));
    }

    public function single(Request $request, $code)
    {
    	\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

    	\Admin::add_to_toolbar(['name'=>'All courses','href'=>route('dsvv.admin.course.index')]);

        \Admin::add_to_toolbar(['name'=>'Create course','href'=>route('dsvv.admin.course.create')]);

        
    
    	if($course = Course::with('session')->where('code',$code)->first())
    	{
            // dd($course->buildCourseFormElement());
    		return view("DsvvView::admin.course.single",compact('course'));
    	}
    }

    public function doSingle(Request $request, $code)
    {
        if($course = Course::with('session')->where('code',$code)->first())
        {
            $keys = array_keys(config('dsvv.course'));
            $course->setCourseData($request->only($keys));
            $course->save();
            return redirect()->route('dsvv.admin.course.single',['code'=>$course->code]);
            // dd($course->buildCourseFormElement());
            return view("DsvvView::admin.course.single",compact('course'));
        }
    }

    public function create(Request $request)
    {
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'All courses','href'=>route('dsvv.admin.course.index')]);

        \Admin::add_to_toolbar(['name'=>'Create course','href'=>route('dsvv.admin.course.create')]);

        $course = new Course;
        // dd($course->formElements(true));

        return view("DsvvView::admin.course.create",compact('course'));
    }

    public function doCreate(Request $request)
    {
        $keys = array_keys(config('dsvv.course'));
        $course = new Course();
        $course->setCourseData($request->only($keys));
        $course->save();
        return redirect()->route('dsvv.admin.course.dosingle',['code'=>$course->code]);
    }
}
