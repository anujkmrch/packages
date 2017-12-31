<?php

namespace Hpp\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hpp\Apps\Client\Models\Application;

use Hpp\Apps\Client\Models\Course;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
    	$applications = Application::get();
    	return view('DevView::Admin.application.index',compact('applications'));
    }

    public function newOnly(Request $request)
    {
    	$applications = Application::get();
    	return view('DevView::Admin.application.index',compact('applications'));
    }

    public function verifiedOnly(Request $request)
    {
    	$applications = Application::get();
    	return view('DevView::Admin.application.index',compact('applications'));
    }

    public function rejectedOnly(Request $request)
    {
    	$applications = Application::get();
    	return view('DevView::Admin.application.index',compact('applications'));
    }

    public function verify(Request $request,$id)
    {
    	$applications = Application::get();
    	return view('DevView::Admin.application.index',compact('applications'));
    }
}