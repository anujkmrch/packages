<?php
namespace Dsvv\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsvv\Models\Course;
use Dsvv\Models\CourseSession;

class CourseController extends Controller
{
	public function Courses(Request $request)
	{
		$session = CourseSession::with('courses')->first();
		return view("DsvvView::client.course.courses",compact('session'));
	}

	public function Course(Request $request,$id)
	{
		$course = Course::with('session')->find($id);
		return view("DsvvView::client.course.single",compact('course'));
	}

	public function Checkout(Request $request,$id)
	{
		$course = Course::with('session')->find($id);
		return view("DsvvView::client.course.single",compact('course'));
	}
}
?>