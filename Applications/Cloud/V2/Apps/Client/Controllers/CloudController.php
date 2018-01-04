<?php
namespace Cloud\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CloudController extends Controller
{
	public function index(Request $request)
	{
		dd(\Auth::user());
		// return view("CloudView::client.home.index");
	}
}
?>