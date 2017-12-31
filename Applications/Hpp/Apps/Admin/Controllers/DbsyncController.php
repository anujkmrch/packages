<?php

namespace Dev\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Dev\Apps\Admin\Models\Frontpage;

class DbsyncController extends Controller
{
    public function index()
    {	
    	$hello = Frontpage::sayHello();
    	$cells = Frontpage::cells();
    	return view('DevView::Admin.frontpage.index',compact('cells'));
    }
}
