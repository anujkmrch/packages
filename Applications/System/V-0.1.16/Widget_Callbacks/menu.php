<?php

if(!function_exists('menu_item_build')):	
	function menu_item_build($elements)
	{
		// dd(\System\Models\Menu::get()->pluck('title','id')->toArray());
		$menus = \System\Models\Menu::get()->pluck('title','id')->toArray();
		$menus[0]= 'All Menus';
		ksort($menus);
		return $menus;
	}
endif;

if(!function_exists('menu_list_build')):	
	function menu_list_build($elements)
	{
		$menus = \System\Models\MenuType::get()->pluck('title','slug')->toArray();
		return $menus;
	}
endif;

?>