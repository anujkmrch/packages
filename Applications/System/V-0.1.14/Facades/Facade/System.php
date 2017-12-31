<?php
namespace System\Facades\Facade;

use Auth,DB;


use System\Models\User;
use System\Models\Role;
use System\Models\Permission;

use System\Models\MenuType;
use System\Models\Menu;

use System\Models\Widgetize;

class System
{

	private $roles = [];
	private $menu;
	private $interface=0;
	private $current = 0;
	private $widgets = null;

	public function hello()
	{
		return "hello";
	}

	function _initialize()
	{
		//create an empty role array;
		$roles = collect([]);
		if($user = User::find(Auth::id())){
			$user->load('roles.permissions');
			
		} else
		{
			$user = Auth::user();
		}
		$roles = $user->roles ? $user->roles : collect([]);

		$permissions = Permission::get();

		foreach($permissions as $permission)
			$this->roles[$permission->slug] = $permission->_default;

		foreach($roles as $key => $role){
			foreach($role->permissions as $permission){
				if(!array_key_exists($permission->slug, $this->roles) or $this->roles[$permission->slug] !== "allow" )
				$this->roles[$permission->slug] = $permission->pivot->permission == null ? $permission->_default : $permission->pivot->permission;
			}
		}

		$role_keys = $roles->groupBy('id')->keys()->toArray();
		array_push($role_keys, config('system.public_role_id',1));

		$role_keys = implode($role_keys,',');

		$query = "SELECT DISTINCT m.*, mt.title as type_title,mt.slug as type_slug from menus as m join menu_types as mt join roles_menus as rm ON m.id = rm.menu_id WHERE rm.role_id in ({$role_keys}) AND mt.id = m.menu_type_id AND m.enabled = 1 ORDER BY m.ordering,m.id ASC";
		// dd($query);
		$menu = DB::select($query);
    	$this->menu = Menu::hydrate($menu)->groupBy('type_slug');

		$query = "SELECT * FROM plugins WHERE active=1 order by ordering ASC";


		$plugins = ['e-commerce'];

		// It's time to add plugin hooks to the system
		// So we can call them later in view or at other place like
		// helper methods or class objects
		// plugin can add or remove the classes

		if(count($plugins))
		{
			define("PLUGINS",dirname(__DIR__).DS.'Plugins');
			foreach($plugins as $plugin)
			{
				$path = PLUGINS.DS.$plugin.DS.$plugin.".php";
				if(file_exists($path))
				{
					include_once $path;
				}
			}
		}
	}

	/**
	 * It return the System User model
	 * @return Object or null System\Models\User
	 */
	public function user()
	{
		$id = Auth::user()->id;
		return User::find($id);
	}


	public function isGuestCreated()
	{
		$user = Auth::user();
		return (!is_null($user->guest) and $user->guest === true) ? true : false;
	}

	public function loginGuestUser()
	{
        $user = new User();
        $user->roles = Role::where('slug',[config('system.guest_role_slug','guest')])->get();
        $user->id = 0;
        $user->guest = true;

        Auth::SetUser($user);
	}

	/**
	 * It checks whether the system user is guest or not
	 * if no user is found than it will return true, else if
	 * user is found it checks whether the guest user is there,
	 * if guest user is there it will return true;
	 * @return boolean true/false
	 */
	public function checkUserObject()
	{
		return Auth::check();
	}

	function setCurrentMenuId($id=0)
	{
		$this->current = $id;
	}

	function getCurrentMenuWidget($position=null)
	{
		//if null widget are not processed so fetch from first time
		if(is_null($this->widgets))
		{
			// $query = "SELECT w.*,wm.configuration as configuration, wm.id as wm_id, wm.position as position FROM widgets as w join widgets_menus as wm on w.id = wm.widget_id WHERE wm.menu_id = ".$this->current.' or wm.menu_id=0 order by wm.ordering';

            $query = "SELECT w.id, wd.path,wd.slug, w.widget_id,w.configuration,w.position from widgetizes as w JOIN widgets as wd ON wd.id=w.widget_id JOIN menu_widgetize as wm ON w.id=wm.widgetize_id WHERE w.enabled=1 AND (wm.menu_id = {$this->current} or wm.menu_id=0) order by w.ordering DESC";

			$widgets = DB::select($query);

			$this->widgets=Widgetize::hydrate($widgets)->groupBy('position');
		}
		return !is_null($this->widgets) ? (is_null($position) ? $this->widgets : ($this->widgets->has($position) ? $this->widgets->get($position) : []) ) : [];
	}

	/**
	 * [can description]
	 * @param  [type] $permission [description]
	 * @return [type]             [description]
	 */
	function can($permission)
	{
		if(array_key_exists($permission,$this->roles)){
			return $this->roles[$permission] == 'allow' ? true : false ;
		}
		return false;
	}

	public function getMenu($menu_name){
		return $this->menu->has($menu_name) ? $this->menu->get($menu_name) : null;
	}
	
}