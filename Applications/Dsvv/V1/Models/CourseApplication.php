<?php

namespace Dsvv\Models;

use Illuminate\Database\Eloquent\Model;

class CourseApplication extends Model
{
    protected $_table = 'course_applications';

    public function Course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function User()
    {
    	return $this->belongsTo(User::class);
    }
}