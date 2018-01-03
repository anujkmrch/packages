<?php
namespace System\Apps\Admin\Models;

class Frontpage
{
	static $cells =
					[
						'system' => [
							'title' => 'System configuration',
							'route' => 'admin.system.index',
							'fa'	=> 'fa-gears',
							'enabled' => true,
							'key' => 'dashboard',
						],
						
						'access' => [
							'title' => 'Access',
							'route' => 'admin.access.index',
							'fa'	=> 'fa-universal-access',
							'enabled' => true,
						],

						'users' => [
							'title' => 'Users',
							'route' => 'admin.user.index',
							'fa'	=> 'fa-users',
							'enabled' => true,
						],

						'menu' => [
							'title' => 'Menu',
							'route' => 'admin.menu.index',
							'fa'	=> 'fa-list-alt',
							'enabled' => true,
						],

						'widget' => [
							'title' => 'Widgets',
							'route' => 'admin.widget.index',
							'fa'	=> 'fa-th-list',
							'enabled' => true,
						],

						'plugin' => [
							'title' => 'Plugin',
							'route' => 'admin.widget.index',
							'fa'	=> 'fa-th-list',
							'enabled' => true,
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
