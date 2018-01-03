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

        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'New Applications','href'=>route('dsvv.admin.application.newonly')]);

        \Admin::add_to_toolbar(['name'=>'Verified Applications','href'=>route('dsvv.admin.application.verifiedonly')]);

        \Admin::add_to_toolbar(['name'=>'Rejected Applications','href'=>route('dsvv.admin.application.rejectedonly')]);

    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function newOnly(Request $request)
    {
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'All Applications','href'=>route('dsvv.admin.application.index')]);

        \Admin::add_to_toolbar(['name'=>'Verified Applications','href'=>route('dsvv.admin.application.verifiedonly')]);

        \Admin::add_to_toolbar(['name'=>'Rejected Applications','href'=>route('dsvv.admin.application.rejectedonly')]);
    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function verifiedOnly(Request $request)
    {
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'All Applications','href'=>route('dsvv.admin.application.index')]);

        \Admin::add_to_toolbar(['name'=>'New Applications','href'=>route('dsvv.admin.application.newonly')]);

        \Admin::add_to_toolbar(['name'=>'Rejected Applications','href'=>route('dsvv.admin.application.rejectedonly')]);

    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function rejectedOnly(Request $request)
    {
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'All Applications','href'=>route('dsvv.admin.application.index')]);

        \Admin::add_to_toolbar(['name'=>'New Applications','href'=>route('dsvv.admin.application.newonly')]);

        \Admin::add_to_toolbar(['name'=>'Verified Applications','href'=>route('dsvv.admin.application.verifiedonly')]);

    	$applications = CourseApplication::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }

    public function verify(Request $request,$id)
    {
    	$applications = Application::get();
    	return view('DsvvView::admin.application.index',compact('applications'));
    }
}