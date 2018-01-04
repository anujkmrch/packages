<?php

namespace Cloud\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
