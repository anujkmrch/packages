<?php

namespace Service\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Service\Apps\Admin\Models\Frontpage;

class FrontpageController extends Controller
{
    public function index()
    {	
    	$cells = [];
    	$cells = \Admin::get_quick_action_buttons();
    	return view('SystemView::admin.frontpage.index',compact('cells'));
    }
}
