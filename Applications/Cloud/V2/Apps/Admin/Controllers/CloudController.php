<?php

namespace Cloud\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
    
use Cloud\Models\User;
use Cloud\Models\File;

class CloudController extends Controller
{
    public function index(Request $request)
    {	
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
        \Admin::add_to_toolbar(['name'=>'Create course','href'=>route('cloud.admin.files')]);

        // \DB::enableQueryLog();
    	$files = File::with('user')->get();
        // dd(\DB::getQueryLog());

       	return view('CloudView::admin.cloud.index',compact('files'));
    }

    public function user(Request $request,$id)
    {
        $user = User::with('files')->where('username',$id)->whereOr('id',$id)->first();
        // $user = User::with('files')->find(\Auth::id());
        return view('CloudView::admin.user.single',compact('user'));
    }

    public function users(Request $request)
    {
        $users = User::with('files')->get();
        return view('CloudView::admin.user.index',compact('users'));
    }
}
