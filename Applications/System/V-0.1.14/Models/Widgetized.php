<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class Widgetize extends Model
{
	protected $_fillable = ['title','position','configuration','widget_id'];

	function widget()
	{
		return $this->belongsTo(Widget::class);
	}

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

    static function buildConfiguration($data)
    {
    	$columns = [];
    	$relations = [];
    	foreach($data as $key => $configuration)
    	{
			foreach($configuration as $method => $information):
				// echo '---'.$method.'---'.$key.'---';
	    		if($method==='relation' && !(is_null($information)))
	    		{
	    			$relations = array_merge($relations,$information);
	    		}
	    		if($method==='column' && !(is_null($information)))
	    		{
	    			foreach($information as $column => $info){
	    				if(method_exists(__CLASS__, $column)){
	    					$result = self::$column($info);

	    					if(count($result)):
		    					$namespace = $result['namespace'];
		    					$value = $result['value'];
		    					$columns[$column][$namespace] = $value;
	    							
		    				endif;

	    				} else {
	    					if(!is_null($info))
	    					$columns[$column] = $info;
	    				}
	    			}
	    		}
	    	endforeach;
    	}
    	return ['columns'=>$columns,'relations'=>$relations];
    	// first we will process the relations
    	
    	// secondly we process the configuration
    	
    	// thirdly we process the column for the widetized table
    	
    }

    static public function configuration($info)
    {
    	$result = [];
    	if(is_array($info)):
	    	foreach($info as $item=> $data)
	    	{
	    		if(is_array($data)){
	    			foreach($data as $key => $value){
		    			$result['namespace'] = $key;
		    			$result ['value'] = $value;
		    		}	
	    		}
	    		
	    		else
	    			$result['namespace'] = $item;
	    			$result ['value'] = $data;
	    	}
	    endif;
    	return $result;
    }

    public function setColumns($columns)
    {
    	foreach($columns as $column => $value)
    	{
    		if(is_array($value) or is_object($value))
    			$value = json_encode($value);
    		$this->$column = $value;
    	}
    }

    public function renderingConfiguration()
    {
    	$configuration= $this->widget->configuration;
    	$c = array_merge($configuration,$this->configuration);
    	return $c;
    }

    public function buildForm($value = false)
    {
    	$configuration= $this->widget->configuration;
    	// $c = array_merge($configuration,$this->configuration);
    	// dd($configuration);
    }
}
