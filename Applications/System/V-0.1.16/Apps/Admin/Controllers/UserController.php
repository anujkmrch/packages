<?php

namespace System\Apps\admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Validator;
use Hash;
use System\Models\User;
use System\Models\Role;

class UserController extends Controller
{
    public function index()
    {	
    	$users = User::get();

        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
        
        \Admin::add_to_toolbar(['name'=>'Create new user','href'=>route('admin.user.create')]);


    	return view('SystemView::admin.user.index',compact('users'));
    }

    public function single(Request $request, $id)
    {	
        // \App::setLocale("hi");
    	$user = User::with('roles')->where('username',$id)->whereOr('email',$id)->first();
    	//$user = User::with('roles')->find($id);

		//get all roles
		$roles = Role::get();

        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
        
        \Admin::add_to_toolbar(['name'=>'Create new user','href'=>route('admin.user.create')]);

        \Admin::add_to_toolbar(['name'=>'All users','href'=>route('admin.user.index')]);

    	return view('SystemView::admin.user.single',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
    	if($user = User::with('roles')->find($id)){
			//check permission
			/** 
			if(!Webodeci::can('can_manage_user') or ($user->id === Auth::id() and Webodeci::can('can_manage_self')))
			{
				abort(403);
			}
			*/


		   	$errors = [];
    		$info = $request->only([
                            'username',
                            'old_password',
                            'new_password',
                            'new_password_confirmation',
                            'email',
                            'avatar',
                            'first_name',
                            'last_name',
                            'company',
                            'roles'
                        ]);
    		//dd($info);
        	//if($user = User::find($id)) {
        	$rules = [	'first_name' =>'required',
                        'last_name' =>'required',
                        'roles' =>'required'];

            //check email and done
    			if($user->email !== strtolower($info['email'])){
    				$rules['email'] = 'required|unique:users';
    				$user->email = $info['email'];
    			}
            
            	//must do the file operation
            	if(!empty($info['avatar'])){

            	}

            	if(!empty($info['first_name']) or !empty($info['last_name'])):

                	// initially set the first name and last name to save 
                	// from the array glitch
                	$first_name = $user->name;
                	$last_name = null;
                
                	//check if name has first and last name
                	//if yes then assign the new values to the first and lastname
                	if($name = explode(' ',$user->name) and count($name) > 1){
                    	list($first_name,$last_name) = $name;
                	}

                	//check if first name is changed
                	if(!empty($info['first_name']) and strcmp($info['first_name'], $first_name) !== 0){
                    	$first_name = $info['first_name'];
                	}

                	//check if last name is changed
                	if(!empty($info['last_name']) and strcmp($info['last_name'], $last_name) !== 0){
                    	$last_name = $info['last_name'];
                	}

                	//create name from first_name and last_name
                	$name = implode(' ', [$first_name,$last_name]);


                	//checking if saved name and created name
                	//if different then update the name in the database
                	if(strcmp($name, $user->name) !== 0)
	                    $user->name = $name;

            	endif;


            	// manage the company
            	if(!empty($info['company']) and strcmp($info['company'], $user->company) !== 0)
                	$user->company = $info['company'];

            	//update the password
                if(!empty($info['new_password']) ):
                    $rules['new_password'] = 'required|min:6|confirmed';
                    $user->password = \Hash::make($info['new_password']);
                endif; //password update finish

            	if($user->isDirty()){
            		$validator = Validator::make($request->all(),$rules);
					if($validator->fails()){
						return redirect()->back()->withErrors($validator)->withInput();
					}
                	$user->save();
                	$request->session()->flash('alert-success', 'Successfully updated');
            	}
    		//} //end of found user
            
        	//if we have  roles defined in the system then only update the role
            if(count($info['roles'])){
                if(config('webodeci.multirole',false))
                    $user->roles()->sync(array_values($info['roles']));
                else
                    $user->roles()->sync([$info['roles']]);
            }

        	return redirect()->back();
		}
		return redirect()->back()->with('error','There is no such user found!');
    }


    public function create(Request $request)
	{
        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
        
        \Admin::add_to_toolbar(['name'=>'All users','href'=>route('admin.user.index')]);

		$roles = Role::get();
		return view('SystemView::admin.user.create',compact('roles'));
	}

	public function doCreate(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username'	=> 'required|max:25|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        	]);

		 if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
        }

		$info = $request->only(['first_name','last_name','username','company','email','password','password_confirmation']);
		$info['name'] = implode(' ',[$info['first_name'],$info['last_name']]);
		$info['password'] = \Hash::make($info['password']);
		$user = User::create($info);
		$roles = [config('dev.default_user_role')];
		
		if(count($request->input('roles')))
			$roles = is_array($request->input('roles')) ? $request->input('roles') : [$request->input('roles')]; //override default user role
		//dd($roles);
		$user->roles()->sync($roles);
		return redirect()->route('admin.user.index');
	}

	public function delete(Request $request)
	{
		//dd($request->input('user'));
		$id = $request->input('user');
		$user = User::find($id);
		$user->roles()->detach();
		$user->delete();
		return redirect()->route('admin.user.index');
	}


    public function search(Request $request)
    {	
    	$id = $request->get('q');
        $roles = [];
    	if($user = User::with('roles')->where('username',$id)->whereOr('email',$id)->first())
            $roles = Role::get();

    	return view('SystemView::admin.user.single',compact('user','roles'));
    }
}