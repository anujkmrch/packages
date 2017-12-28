<?php

namespace System\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use System\Apps\Admin\Models\Frontpage;

class SystemController extends Controller
{
    public function index()
    {	
    	$hello = Frontpage::sayHello();
    	$cells = Frontpage::cells();
    	return view('SystemView::admin.frontpage.index',compact('cells'));
    }
}
