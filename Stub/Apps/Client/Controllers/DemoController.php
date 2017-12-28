<?php
namespace $namespace\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
	public function index(Request $request)
	{
		return view('$namespaceView::client.demo.index');
	}
}
?>