<?php
namespace Dsvv\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsvv\Models\CourseSession;

class HomeController extends Controller
{
	public function index(Request $request)
	{
		$session = CourseSession::with('courses')->first();
		return view("DsvvView::client.home.index");
	}
}
?>