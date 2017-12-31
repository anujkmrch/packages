<?php
namespace Hpp\Apps\Admin\Models;

class Frontpage
{
	static $cells =
					[
						'attendance' => [
							'title' => 'Attendance',
							'route' => 'admin.application.index',
							'fa'	=> 'fa-archive',
							'enabled' => true,
						],
						'buses' => [
							'title' => 'Buses',
							'route' => 'admin.course.index',
							'fa'	=> 'fa-gears',
							'enabled' => true,
						],

						'routes' => [
							'title' => 'Routes',
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
