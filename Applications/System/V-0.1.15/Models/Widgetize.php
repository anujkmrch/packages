<?php

namespace System\Models;

use Illuminate\Database\Eloquent\Model;

class Widgetize extends Model
{
	
	protected $_fillable = ['title','position','configuration','widget_id'];
	
	private $formConfiguration = null;

	function widget()
	{
		return $this->belongsTo(Widget::class);
	}

	function menus()
	{
		return $this->belongsToMany(Menu::class,'menu_widgetize');
	}

	function setOrderingAttribute($value)
	{
		if(empty($value) and !is_integer($value))
		{
			$this->attributes['ordering'] = 0;
		}
		$this->attributes['ordering'] = $value;
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

    function setConfigurationAttribute($value)
    {
        if(is_array($value))
            $this->attributes['configuration'] = json_encode($value);
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
     * Build saving values into the table to create new widget
     * @param [type] $data      [description]
     * @param [type] $requested [description]
     */
    static function Widgetized($data,$requested)
    {
    	$columns = [];
    	$relations = [];
    	// dd($data);
    	// dd($requested);
    	foreach($data as $key => $configuration)
    	{
    		if(!array_key_exists('scope', $configuration))
    			continue;

    		$scope = 'extract'.ucfirst($configuration['scope']);
    		// if(array_key_exists($key, $requested) and method_exists(__CLASS__, $scope))
    		
			if(array_key_exists($key, $requested))
    		{
    			$scope = $configuration['scope'];
    			switch($scope){
    				case 'column':
    					if($key!=='configuration')
    						$columns[$key] = $requested[$key];
    				break;

    				case 'configuration':
    					$columns['configuration'][$key] = $requested[$key];
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
    	}
    	return (['columns'=>$columns,'relations'=>$relations]);

    	// first we will process the relations
    	
    	// secondly we process the configuration
    	
    	// thirdly we process the column for the widetized table
    }

    /**
     * Generate formConfiguration for widget editing
     * @return [type] [description]
     */
    public function renderingConfiguration()
    {
    	if($this->formConfiguration == null):
	    	$keys = array_merge($this->widget->configuration,config('system.widgetize_extracter',[]));
	    	foreach($keys as $key => $configuration):
	    		if(array_key_exists('scope', $configuration)):
	    			$scope = $configuration['scope'];
	    			$configuration['widget_id'] = $this->id;
	    			switch($scope):
	    				case 'configuration':
	    					if($this->hasConfiguration($key))
	    						$value = $this->getConfiguration($key);
	    					$keys[$key]['value'] = $value;
	    					// echo "---{$scope}---{$key}---";
	    				break;

	    				case 'column':
	    					$keys[$key]['value'] = $this->$key;
	    				break;

	    				case 'relation':
	    					if($configuration['builder']==='default'):
	    						$keys[$key]['value'] = $this->$key;
	    						if(is_callable($configuration['extractor']))
	    							$keys[$key]['value'] = $configuration['extractor']($keys[$key]['value'],$configuration);
	    					endif;
	    					
	    					// if(is_callable($configuration['builder']))
	    					// 	$keys[$key]['value'] = $configuration['builder']();

	    					// if(is_callable($configuration['extractor']))
	    					// 	$keys[$key]['value'] = $configuration['extractor']($keys[$key]['value'],$configuration);
	    					
	    					
	    				break;
	    			endswitch;
	    		endif;
	    	endforeach;
	    	$this->formConfiguration = $keys;
	    endif;
    	return $this->formConfiguration;

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

    public function saveRelations($relations)
    {
    	$configuration = array_merge($this->widget->configuration,config('system.widgetize_extracter',[]));
    	// dd($configuration);
    	//need to execute 2d array
    	foreach($relations as $type => $relation)
    	{
    		foreach($relation as $key => $value)
    		{
    			// echo $configuration[$key]['builder'];
    			// echo $type;

    			if($type === $configuration[$key]['builder'] 
    				and $type === 'default' 
    				and array_key_exists('builder_method', $configuration[$key])
    			)
    			{
    				$builder = $configuration[$key]['builder_method'];
    			//	echo $key;
    				if($builder === 'sync'):
    					if(!is_array($value))
    						$value = [];
    					// check if we have to put it on every menu, if so 
    					// remove other multiple menu and make it available
    					// to every menu
    					if(in_array(0,$value))
    						$value = [0];
    				endif;
    				$this->$key()->$builder($value);
    			}
    		}
    	}
		return;
    }

    // public function buildForm($value = false)
    // {
    // 	$configuration= $this->widget->configuration;
    // 	// $c = array_merge($configuration,$this->configuration);
    // 	// dd($configuration);
    // }

    // static public function extractConfiguration($configuration,$data){
    // 	// echo __METHOD__;
    	
    // }
}
