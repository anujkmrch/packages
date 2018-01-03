<?php
namespace System\Seeds;

use Illuminate\Database\Seeder;

use System\Models\Role;
use System\Models\Permission;
use System\Models\MenuType;
use System\Models\Menu;
use System\Models\Widget;
use System\Models\Widgetize;
use System\Models\User;
use System\Models\SlugTrack;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=['title'=>'Public','slug'=>'public','enabled'=>1];
        $public=Role::create($role);

        $role=['title'=>'Guest','slug'=>'guest','enabled'=>1];
        $guest=Role::create($role);
        
        $role=['title'=>'Administrator','slug'=>'administrator','enabled'=>1];
        $administator=Role::create($role);
        
        $role=['title'=>'Subscriber','slug'=>'subscriber','enabled'=>1];
        $subscriber=Role::create($role);
        
        $role=['title'=>'Editor','slug'=>'editor','enabled'=>1];
        $editor=Role::create($role);

        $permission=['title'=>'Can access admin','slug'=>'can_access_admin','_default'=>'deny','enabled'=>1];

        $access_admin = Permission::create($permission);

        if($admin = Role::where('slug','administrator')->first()):
	    	if($access=Permission::where('slug','can_access_admin')->first()):
	    		$admin->Permissions()->save($access,['permission'=>'allow']);
	    	endif;
	    endif;

	    //
	    // create menu type
	    //

	    $user_menu = MenuType::create(['title'=>'User menu','slug'=>'user_menu','app'=>'frontend','enabled'=>1]);

	    
	    $login = new Menu(['title'=>'Login','slug'=>route('auth.login'),'enabled'=>true,'route'=>'','route_options'=>'','parent_id'=>null,'ordering'=>0]);

		$signup = new Menu(['title'=>'Sign up','slug'=>route('auth.register'),'enabled'=>true,'route'=>'','route_options'=>'','parent_id'=>null,'ordering'=>0]);

		['menu' =>[
				'title' => 'Select menu',
				'type' => 'select',
				'validations' => ['not_empty'],
				'callback' => 'menu_list_build'
				'scope' => 'configuration',
				'multiple' => false, 
				'required' => true 
			],
		];

	    //	    
	    // create default widgets

	    //creating menu default widget to render
	    $widget = [
	    		'title'=> 'Menu',
	    		'slug'=>'system_menu',
	    		'description'=>'This is the default system menu widget',
	    		'enabled'=>true,
	    		'configuration'=>[
	    						'menu' =>[
									'title' => 'Select menu',
									'type' => 'select',
									'validations' => ['not_empty'],
									'callback' => 'menu_list_build'
									'scope' => 'configuration',
									'multiple' => false, 
									'required' => true 
								],
							],
				'path' => 'Widgets',
			];

			$w = new Widget($widget);
			
    }
}