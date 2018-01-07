<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    protected $fillable = ['title','slug','app','enabled'];

    public function Menus(){
    	return $this->hasMany(Menu::class,'menu_type_id');
    }
}
