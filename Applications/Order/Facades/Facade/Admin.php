<?php
namespace System\Facades\Facade;

class Admin
{

	private $menu = [];

	private $quick_action_button = [];

	public function hello()
	{
		return "hello";
	}

	/**
	 * Add menu items into the admin menu
	 * @param [type] $menu      array of container menu item information
	 * @param string $namespace default location
	 */
	public function add_menu($menu,$namespace='sidebar')
	{
		if(!array_key_exists($namespace, $this->menu))
			$this->menu[$namespace] = [];
		//array_push($this->menu[$namespace], $menu);
		$this->menu[$namespace][] = $menu;
	}

	/**
	 * Return menu items for admin  menu
	 * @param  [type] $namespace [description]
	 * @return [type]            [description]
	 */
	public function get_menus($namespace=null)
	{
		if($namespace){
			return array_key_exists($namespace,$this->menu) ? $this->menu[$namespace] : null;
		}
		return $this->menu;
	}

	public function add_quick_action_button($button)
	{
		$this->quick_action_button[] = $button;
	}

	public function get_quick_action_buttons()
	{
		return $this->quick_action_button;
	}


}