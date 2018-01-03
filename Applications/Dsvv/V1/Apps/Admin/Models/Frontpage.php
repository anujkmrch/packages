<?php
namespace Dsvv\Apps\Admin\Models;

class Frontpage
{
	static $cells =
					[
						'application' => [
							'title' => 'Application',
							'route' => 'admin.application.index',
							'fa'	=> 'fa-archive',
							'enabled' => true,
						],
						'courses' => [
							'title' => 'Courses',
							'route' => 'admin.course.index',
							'fa'	=> 'fa-gears',
							'enabled' => true,
						],

						'sync' => [
							'title' => 'Oracle /-/ MySql',
							'route' => 'admin.dbsync.index',
							'fa'	=> 'fa-refresh',
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
