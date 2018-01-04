<?php

namespace Cloud\Models;

use System\Models\User as SystemUser;

class User extends SystemUser
{
    public function Files()
    {
    	return $this->hasMany(File::class);
    }
}