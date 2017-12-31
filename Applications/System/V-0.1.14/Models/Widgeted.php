<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{

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
        
        $array = array_merge($request,config('system.widgetize_extracter',['title'=>'extract_widget_title','show'=>'extract_widget_menu']));
        // dd($array);
        // we need two configuration array separators,
        // one for relation data (e.g. saving widgetized menu items)
        // and other for saving widgetized configurations
        
        $configuration = [];
        //['relation'=>[],'configration'=>[],'column'=>[]];
        foreach($array as $key => $extractor)
        {
            if(
                (!is_null($extractor) 
                    and !is_bool($extractor)) 
                and is_callable($extractor)
            ){
                $configuration[$key] = $extractor($request);
                // if(!is_null($value = $extractor($request))){
                //     $information[$key] = $value;
                // }
            }
            else{
               
                $configuration[$key]["relation"] = null;
                // $configuration[$key]["configuration"][$key] = $extractor;
                $configuration[$key]['column']["configuration"][$key] = $extractor; //= null;
            }
        }
        return $configuration;
        // dd(json_encode($configuration));
        // dd(json_encode($configuration));
        
        // dd($this->configuration);
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