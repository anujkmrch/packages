<?php
namespace System\Seeds;
use Illuminate\Database\Seeder;

use System\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = ['title' => 'Can access admin','slug' => 'can_access_admin','_default' => 'deny','enabled' =>1];

        Permission::create($permission);
        
    }
}
