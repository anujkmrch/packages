<?php

namespace System\Models;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
	use NodeTrait;
    protected $fillable = ['menu_type_id','title','slug','enabled','route','route_options','parent_id','ordering'];


    public function Type(){
    	return $this->belongsTo(MenuType::class,'menu_type_id');
    }

    public function getParentIdAttribute($value)
    {
		return ( $value == null ? 0 : $value );
    }

    public function Roles(){
    	return $this->belongsToMany(Role::class,'roles_menus');
    }

    public function Widgets(){
        return $this->belongsToMany(Widget::class);
    }
}