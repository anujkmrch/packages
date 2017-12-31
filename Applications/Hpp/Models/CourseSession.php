<?php

namespace Dsvv\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
	protected $_table = 'course_sessions';
	protected $_fillable = [
    				'title',
    				'application_starts_on',
    				'applications_ends_on',
    				'starts_from',
    				'ends_on',
    			];

	public function Courses()
	{
		return $this->hasMany(Course::class);
	}

}
