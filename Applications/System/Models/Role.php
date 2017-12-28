<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

// use System\Models\Permission;
// use System\Models\User;
// use System\Models\Menu;

class Role extends Model
{
    protected $fillable = ['title','slug','enabled'];

    protected $hidden = array('pivot.role_id');

    function Permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions','role_id','permission_id')->withPivot('permission');
    }

    function User()
    {
        return $this->belongsTo();
    }
    

    function Users()
    {
        return $this->belongsToMany(User::class,'users_roles','user_id','role_id');
    }

    public function Menus($unique = false){
        if($unique){

        }
        return $this->belongsToMany(Menu::class,'roles_menus','menu_id','role_id')->distinct('menu_id');
    }
}
