<?php
namespace System\Seeds;
use Illuminate\Database\Seeder;


use System\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = ['title' => 'Public','slug' => 'public','enabled' =>1];
        Role::create($role);

        $role = ['title' => 'Guest','slug' => 'guest','enabled' =>1];
        Role::create($role);
        
        $role = ['title' => 'Administrator','slug' => 'administrator','enabled' =>1];
        Role::create($role);
        
        $role = ['title' => 'Subscriber','slug' => 'subscriber','enabled' =>1];
        Role::create($role);
        
        $role = ['title' => 'Editor','slug' => 'editor','enabled' =>1];
        Role::create($role);

    }
}
