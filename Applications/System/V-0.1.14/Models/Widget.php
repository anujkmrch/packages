<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    private $formConfiguration = null;

    function getConfiguration($key)
    {
    	if(is_null($this->configuration))
    	{
    		return null;
    	}
    	if(is_string($this->configuration))
    	{
    		$this->configuration = json_decode($this->configuration,true);
    	}
    	if(is_array($this->configuration) and array_key_exists($key, $this->configuration))
    		return  $this->configuration[$key];
    	return null;
    }

    function hasConfiguration($key)
    {
        if(is_null($this->configuration))
        {
            return false;
        }
        if(is_string($this->configuration))
        {
            $this->configuration = json_decode($this->configuration,true);
        }
        if(is_array($this->configuration) and array_key_exists($key, $this->configuration))
            return  true;
        return false;
    }

    function getConfigurationAttribute($value)
    {
        if(is_null($value))
        {
            return $value;
        }
        if(is_string($value))
        {
            $value = json_decode($value,true);
        }

       return $value;
    }

    /**
     * Method to build the widget's widgetized configuration
     * 
     * @param  object $request received form data from the post request
     * @return array          return the configuration array for widgetized 
     *                        entry
     */
    function buildWidgetizeConfiguration($request){
        // $configuration = [
        //     'menu' => null,
        //     'title'=>null,
        //     'show'=>'build_assign_widget_menu'
        // ];

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
            
            $array = array_merge($this->configuration,config('system.widgetize_extracter',[]));
            return $array;
            // dd($request);
            // dd($array);

            // we need two configuration array separators,
            // one for relation data (e.g. saving widgetized menu items)
            // and other for saving widgetized configurations
            
            $configuration = [];
            //['relation'=>[],'configration'=>[],'column'=>[]];
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
                    // $configuration[$key]["configuration"][$key] = $extractor;
                    $configuration[$key]['column']["configuration"][$key] = $extractor; //= null;
                }
            }
            $this->formConfiguration = $configuration;
        endif;
        return $this->formConfiguration;

        // dd(json_encode($configuration));

        // dd(json_encode($configuration));

        // dd($this->configuration);
    }

    function formConfiguration()
    {
         return $array = array_merge($this->configuration,config('system.widgetize_extracter',[]));
    }

    /**
     * return the entries of widgetized objects for a widget
     */
    function Widgetized()
    {
        return $this->hasMany(Widgetize::class);
    }

	function menus()
	{
		return $this->belongsToMany(Menu::class,'widgets_menus')->withPivot('configuration','id');
	}
}