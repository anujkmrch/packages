<?php
namespace Cloud\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cloud\Models\User;
class CloudController extends Controller
{
	public function index(Request $request)
	{
		if(!\System::can('can_access_cloud')):
        	if (!\Auth::guest() and !\System::isGuestCreated()) {
                abort('403');
        	}
        	else {
        		return view('CloudView::auth.login',compact('user'));
        	}
        endif;

		$user = \Cloud::UserWithFiles();
		return view('CloudView::client.cloud.user',compact('user'));
		// dd(\Auth::user());
		// return view("CloudView::client.home.index");
	}
}
?>