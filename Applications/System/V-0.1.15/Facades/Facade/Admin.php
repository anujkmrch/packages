<?php
namespace System\Facades\Facade;
use System\Models\Menu;

class Admin
{

	private $menu = [];

	private $menus = [];

	private $quick_action_button = [];

	private $dashboard = [];

	/**
	 * Add menu items into the admin menu
	 * @param [type] $menu      array of container menu item information
	 * @param string $namespace default location
	 */
	public function add_menu($menu,$namespace='sidebar',$hasParent=false)
	{
		if(!array_key_exists($namespace, $this->menu))
			$this->menu[$namespace] = [];
		// $this->menu[$namespace][] = $menu;
		$parent_id = 0;
		// if(isset($menu['parent_slug']))
		// {
		// 	foreach($this->menu[$namespace] as $id => $item)
		// 	{
		// 		if(!is_null($menu['parent_slug']))
		// 		{
		// 			$parent_id = $id;
		// 		}
		// 	}
		// }
		// $menu['parent_id'] = $parent_id;
		$this->menu[$namespace][$menu['slug']] = $menu;
	}

	function add_admin_menu($key,$value, $namespace='sidebar')
	{
		if(!array_key_exists($namespace,$this->menus))
			$this->menus[$namespace] = [];

		if(!array_key_exists($key, $this->menus[$namespace]))
			$this->menus[$namespace][$key] = $value;
	}

	function remove_admin_menu($key,$namespace='sidebar')
	{
		if(!array_key_exists($namespace,$this->menus))
			return false;

		if(array_key_exists($key, $this->menus[$namespace])){
			unset($this->menus[$namespace][$key]);
			return true;
		}
		return false;
	}

	/**
	 * Return menu items for admin  menu
	 * @param  [type] $namespace [description]
	 * @return [type]            [description]
	 */
	function get_menus($namespace=null)
	{
		if(!is_array($namespace) and is_array($this->menu)){
			if( array_key_exists($namespace,$this->menu) )
				return $this->menu[$namespace];
			return [];
		}
		return $this->menu;
	}

	function has_menus($namespace)
	{
		if(array_key_exists($namespace, $this->menus) and count($this->menus[$namespace]))
			return true;
		return false;
	}

	function getHydratedMenu($namespace,$ul_menu = false,$dropdown='navi')
	{
		$menus = $this->menus[$namespace];
		ksort($menus);
		$k = collect($menus)->sortBy(function($item) use ($menus){
			return $item;
		});
		// dd($k);
		$key_files = collect($menus)->sortBy('__base__.slug')->toArray();
		// ksort($key_files);
		// method defined in admin helper to explode array tree by slug
		// based key

		$tree = collect(explodeTree($key_files, "/", true))->sortBy('__base__.ordering');
		// dd($tree);
		if($ul_menu):
			return "<ul class=\"nav nav-{$namespace}\">".buildUlExplodedTree($tree,$dropdown)."</ul>";
		endif;
		return $tree;
		
		// // dd();
		// // Show //
		// dd($tree);

		// $tree = collect($this->get_menus($namespace))->sortBy('ordering');
		// if($ul_menu):
		// 	// dd($this->get_menus($namespace));
		// 	return "<ul class=\"nav nav-{$namespace}\">".buildUlTree($tree,'parent_slug','slug',$dropdown)."</ul>";
		// endif;
		// return buildTree($tree,'parent_slug','slug');
		// return Menu::hydrate($this->menu[$namespace])->toTree();
	}

/**
 * [buildMenu description]
 * @param  [type]  $menu_array [description]
 * @param  boolean $is_sub     [description]
 * @return [type]              [description]
 */
	public function build_admin_ul_menu($namespace, $is_sub=FALSE) {
		$menu = $this->get_menus($namespace);

		if(is_array($menu) and count($menu)):
			foreach($menu as $item):
				print_r($item);
			endforeach;
		endif;
		return null;
	}

	public function add_quick_action_button($button)
	{
		array_push($this->quick_action_button, $button);
	}

	public function get_quick_action_buttons()
	{
		// dd($this->quick_action_button);
		return $this->quick_action_button;
	}


	public function add_admin_dashboard(array $configuration)
	{
		$this->dashboard[] = $configuration;
	}

	public function get_admin_dashboard()
	{
		return $this->dashboard;
	}
}