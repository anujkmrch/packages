<?php

namespace Dsvv\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsvv\Models\CourseApplication;

use Dsvv\Models\Course;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function newOnly(Request $request)
    {
    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function verifiedOnly(Request $request)
    {
    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function rejectedOnly(Request $request)
    {
    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function verify(Request $request,$id)
    {
    	$applications = Application::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }
}