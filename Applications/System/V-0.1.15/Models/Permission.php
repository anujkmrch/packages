<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $fillable = ['title','slug','_default'];
	
    public function Roles(){
    	$this->belongsToMany(Role::class,'roles_permissions','permission_id','role_id');
    }
}