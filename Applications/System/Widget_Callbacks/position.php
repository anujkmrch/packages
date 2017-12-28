<?php
if(!function_exists('position_list_build')):	
	function position_list_build($elements)
	{
		// dd(\System\Models\Menu::get()->pluck('title','id')->toArray());
		$positions = config('system.positions');
		// dd($positions);
		// array_push($positions,['default'=> 'Default']);
		return $positions;
		// return [0 => 'All menus', 12 => "Login",13=>"Logout"];
	}
endif;
?>