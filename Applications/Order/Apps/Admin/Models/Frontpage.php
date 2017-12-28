<?php
namespace Order\Apps\Admin\Models;

class Frontpage
{
	static $cells =
					[
						'order' => [
							'title' => 'Orders',
                            'route' => 'admin.system.index',
                            'fa'    => 'fa-gears',
                            'enabled' => true,
                            'key' => 'dashboard',
						],
					];

	static public function addCell($key,$cell)
	{
		array_push(self::$cells, $key[$cell]);
	}

	static public function Cells()
	{
		return self::$cells;
	}

	static public function removeCell($key)
	{
		if(array_key_exists($key, self::$cells)){
			$data =  self::$cells[$key];
			unset(self::$cells[$key]);
			return data;
		}
		return false;
	}

	static public function sayHello()
	{
		return "Hello from frontpage list";
	}
}

?>
