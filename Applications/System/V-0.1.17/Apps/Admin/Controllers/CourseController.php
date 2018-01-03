<?php

namespace Dev\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Dev\Apps\Admin\Models\Frontpage;

use Dev\Apps\Client\Models\Apply;
use Dev\Apps\Client\Models\Course;

class CourseController extends Controller
{
    public function index()
    {	
       	// return view('DevView::Admin.frontpage.index',compact('cells'));
    }
}
