<?php

namespace Dsvv\Models;

use System\Models\User as SystemUser;

class User extends SystemUser
{
    public function Applications()
    {
    	return $this->hasMany(CourseApplication::class);
    }
}