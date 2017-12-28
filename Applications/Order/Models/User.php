<?php

namespace System\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use System\Models\Role;

// use Codebloop\Contracts\ServiceSubscriberInterface;
// use Codebloop\Traits\ServiceSubscriber;

class User extends Authenticatable {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $events = [
    //     'saved' => UserSaved::class,
    //     'deleted' => UserDeleted::class,
    // ];
    
    public function Roles(){
        return $this->belongsToMany(Role::class,'users_roles','user_id','role_id');
    }

    public function getFirstNameAttribute(){
        if($name = explode(' ',$this->name) and count($name) > 1){
            list($first_name,$last_name) = $name;
            return $first_name;   
        }
        return $this->name;
         
    }

    public function getLastNameAttribute(){
         if($name = explode(' ',$this->name) and count($name) > 1){
            list($first_name,$last_name) = $name ;
            if(count($name) > 2){
                array_shift($name);
                $last_name = implode(' ', $name);
            }
            return $last_name;   
        }
        return null;
    }

    public function amIAdmin()
    {
        return $this->roles->where('slug','administartor')->first() ? true : false;
    }

   
}