<?php

namespace Dsvv\Models;

use Illuminate\Database\Eloquent\Model;
use Order\Contracts\CartItemInterface;

class Course extends Model
{
    protected $_table = 'courses';

    /**
     * Boot function for using with User Events.
     *
     * @todo Move events to an Observer.
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
           
        });

        static::saving(function ($model) {
            // Set period if it wasn't set
            // if (! $model->ends_at) {
            //     $model->setNewPeriod();
            // }
        });

        static::saved(function ($model) {
            if ($model->getOriginal('plan_id') !== $model->plan_id) {
                event(new SubscriptionPlanChanged($model));
            }
        });
    }

    public function Session()
    {
    	return $this->belongsTo(CourseSession::class,'course_session_id');
    }

    public function Applications()
    {
    	return $this->hasMany(CourseApplication::class);
    }

    /**
     * Save the course item from request object, whether it is new or old
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function setCourseData($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function formElements($forNew = false)
    {
        if($forNew){
          return config('dsvv.course');
        }
        return $this->formConfiguration;
    }

    public function buildCourseFormElement($recreate=false)
    {
        if($this->formConfiguration == null or $recreate):
        $data = config('dsvv.course');
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

    function buildCourseConfiguration($request=null){

        // overwriting the default widget_extractor callbacks in any case
        // developer messed with the defautl extraction call backs for the
        // system widget
        // $keys = array_keys(config('system.widgetize_extracter',[]));
        if($this->formConfiguration == null):
            // $array = array_merge($request,config('system.widgetize_extracter',[
            //         'title'      => [
            //             'title' => 'Title',
            //             'type' => 'text',
            //             'scope' => 'column',
            //             'callback' => 'extract_widget_title',
            //             'validations' => array('not_empty'),
            //         ],
            //         'menu' => [
            //             'title' => 'Select menu',
            //             'type' => 'select',
            //             'validations' => array('not_empty'),
            //             'callback' => 'menu_list_build',
            //             'scope' => 'configuration',
            //             'multiple' => false,
            //             'required'  => true,
            //           ],
            //         'position' => [
            //             'title' => 'Position',
            //             'type' => 'select',
            //             'validations' => array('not_empty'),
            //             'callback' => 'position_list_build',
            //             'scope' => 'column',
            //             'multiple' => false,
            //             'required'  => true,
            //           ],
            //         'sync' => [
            //             'title' => 'Choose to show on menu',
            //             'type' => 'select',
            //             'validations' => array('not_empty'),
            //             'callback' => 'menu_item_build',
            //             'scope' => 'relation',
            //             'multiple' => true,
            //         ],
            //     ]));
            //     
            
            $array = array_merge($this->configuration,config('dsvv.widgetize_extracter',[]));
            return $array;

            // we need two configuration array separators,
            // one for relation data (e.g. saving widgetized menu items)
            // and other for saving widgetized configurations
            $configuration = [];
            foreach($array as $key => $extractor)
            {
                if(!array_key_exists($key,$request) 
                    or !array_key_exists('scope',$extractor))
                {
                    continue;
                }

                if( is_array($extractor)
                    and array_key_exists('callback',$extractor)
                    and is_callable($extractor['callback']) ) 
                {
                    echo $extractor['callback'];
                    $configuration[$key] = $extractor['callback']($request);
                } 
                else
                {
                    $configuration[$key]["relation"] = null;
                    $configuration[$key]['column']["configuration"][$key] = $extractor; //= null;
                }
            }
            $this->formConfiguration = $configuration;
        endif;
        return $this->formConfiguration;
    }
}
