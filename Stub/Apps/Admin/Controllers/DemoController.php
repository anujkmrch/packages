<?php

namespace $namespace\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use $namespace\Apps\Admin\Models\Frontpage;

class DemoController extends Controller
{
    public function index()
    {	
    	return view('$namespaceView::admin.demo.index');
    }
}
