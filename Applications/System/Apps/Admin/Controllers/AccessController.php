<?php

namespace System\Apps\Admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use System\Models\Role;
use System\Models\Permission;

class AccessController extends Controller
{
    public function index()
    {	
    	$roles = Role::get();
    	$permissions = Permission::get();
    	return view('SystemView::admin.access.index',compact('roles','permissions'));
    }

    public function roleCreate(Request $request)
    {
    	$permissions = Permission::get();
    	return view("SystemView::admin.access.create-role",compact('permissions'));
    }

    public function doRoleCreate(Request $request)
    {
    	$info = $request->input('role');
        // dd($info);
    	if(empty($info['title']) or empty($info['slug']) or empty($info['enabled']) )
    	{
    		$request->session()->flash('alert-danger', 'Information missing');
	
			return redirect()->back();
    	}
    	$role = Role::create($info);

    	$called = collect($request->permission)->whereIn('permission',['allow','deny']);
		$permissions = Permission::whereIn('slug',$called->pluck('name')->values()->toArray())->get();
		$array = [];
		foreach($permissions as $permission){
			$requested = $called->where('name',$permission->slug)->first();
			$array[$permission->id]= ['permission' => $requested['permission'] ]; 
		}
		if(count($array))
			$role->permissions()->sync($array);

		$request->session()->flash('alert-success', 'Role created');
		return redirect()->route('admin.access.role',['role'=>$role->slug]);
    }

    public function role(Request $request,$role)
    {
    	$role = Role::with('permissions')->where('slug',$role)->first();
    	$permissions = Permission::get();
    	return view("SystemView::admin.access.role",compact('role','permissions'));
    }

    public function doRole(Request $request,$role)
    {
    	if ($role = Role::with('permissions')->where('slug',$role)->first() ){
			$called = collect($request->permission)->whereIn('permission',['allow','deny']);
			$permissions = Permission::whereIn('slug',$called->pluck('name')->values()->toArray())->get();
			$array = [];
			foreach($permissions as $permission){
				$requested = $called->where('name',$permission->slug)->first();
				$array[$permission->id]= ['permission' => $requested['permission'] ]; 
			}
			if(count($array))
				$role->permissions()->sync($array);
		}
		return redirect()->back();
    }

    public function doPermission(Request $request)
    {
    	$info = $request->input('permission');
    	if(empty($info['title']) or empty($info['slug']) or empty($info['_default']) )
    	{
    		$request->session()->flash('alert-danger', 'Information missing');
	
			return redirect()->back();
    	}
    
    	$permission = Permission::create($info);
    	
    	$request->session()->flash('alert-success', 'Permission created');
	
		return redirect()->back();
    }

    public function roleTrash(Request $request,$role)
    {
    	if($item = Role::find($role))
		{
			if($item->permissions)
				$item->permissions()->detach();

			$item->delete();
			
			$request->session()->flash('alert-success','Role deleted');
			
			return redirect()->back();
		}
		
		$request->session()->flash('alert-error','There is no such role found');
		return redirect()->back();
    }

    public function permissionTrash(Request $request,$permission)
    {
    	if($item = Permission::find($permission))
    		{
    			if($item->roles())
    				$item->roles()->detach();
    			$item->delete();
    			$request->session()->flash('alert-success','Permission deleted');
				return redirect()->back();
    		}
		$request->session()->flash('alert-danger', 'No Permission found');
		return redirect()->back();
    }
}