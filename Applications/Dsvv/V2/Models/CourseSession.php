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


	/**
     * Save the course item from request object, whether it is new or old
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function setSessionData($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function formElements($forNew = false)
    {
        if($forNew){
          return config('dsvv.session');
        }
        return $this->formConfiguration;
    }

	public function buildCourseFormElement($recreate=false)
    {
        if($this->formConfiguration == null or $recreate):
        $data = config('dsvv.session');
        $columns = [];
        $relations = [];
        foreach($data as $key => $configuration)
        {
            if(!array_key_exists('scope', $configuration))
                continue;

            // $scope = 'extract'.ucfirst($configuration['scope']);
            // if(array_key_exists($key, $requested) and method_exists(__CLASS__, $scope))
            
            $scope = $configuration['scope'];
            switch($scope){
                case 'column':
                    if($key!=='configuration')
                        $data[$key]['value'] = $this->$key;
                break;

                case 'configuration':
                    $columns['configuration'][$key] = $this->$key;
                break;

                case 'relation':
                    $builder = 'default';
                    if(array_key_exists('builder', $configuration) 
                        and $configuration['builder'] !== 'default' and !empty($configuration['builder']))
                        $builder = $configuration['builder'];
                        $relations[$builder][$key] = $requested[$key];
                break;
            }
        }
        $this->formConfiguration = $data;
        endif;
        return $this->formConfiguration;
    }

}
