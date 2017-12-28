<?php
namespace System\Seeds;
use Illuminate\Database\Seeder;


use System\Models\Role;
use System\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    if($admin = Role::where('slug','administrator')->first()):
    	if($access=Permission::where('slug','can_access_admin')->first()):
    		$admin->Permissions()->save($access,['permission'=>'allow']);
    	endif;
    endif;
    }
}
