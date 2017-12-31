<?php

if(!function_exists('extract_widget_title')):
	function  extract_widget_title($array)
	{
		$default = [
					'relation' => null,
					'column' => ['title'=> null,'configuration' => null,],
				];
		if(array_key_exists('title', $array)):
			$default['column']['title'] = $array['title'];
		endif;
		return $default;
	}
endif;

if(!function_exists('extract_widget_menu')):
	function  extract_widget_menu($array)
	{
		$default = [
				'relation' => [
					'menus'=>
						[
							'type'=>'sync',
							'data'=>[]
						]
					],
					'column' => ['title'=> null,'configuration' => null,],
				];
		if(array_key_exists('show', $array)):
			$default['relation']['menus']['data'] = $array['show'];
		endif;

		return $default;
	}
endif;

if(!function_exists('extract_widget_position')):
	function  extract_widget_position($array)
	{
		$default = [
					'relation' => null,
					'column' => ['title'=> null,'configuration' => null,],
				];

		if(array_key_exists('position', $array)):
			$default['column']['position'] = $array['position'];
		endif;

		return $default;
	}
endif;

if(!function_exists('widget_menus_extractor'))
{
	function widget_menus_extractor($values,$configuration)
	{

		if(array_key_exists('multiple', $configuration) 
			and $configuration['multiple']
			and (is_array($values) or is_object($values))
			and array_key_exists('extractor_key', $configuration)
		){
			$result = [];
			if($values->count()){
				$values = collect($values);
				$result = $values->pluck($configuration['extractor_key']);
				if(method_exists($values, 'toArray') )
					$result = $result->toArray();
			} else
			{
				$query = "SELECT * FROM menu_widgetize where widgetize_id={$configuration['widget_id']}";
				$w = \DB::select($query);
				if(is_array($w) and count($w))
					$result = [0];
			}
			return $result;
		}
	return $values;

	}
}

?>