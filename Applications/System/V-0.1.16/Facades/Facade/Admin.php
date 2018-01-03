<?php
namespace System\Facades\Facade;
use System\Models\Menu;

class Admin
{

	private $menu = [];

	private $menus = [];

	private $quick_action_button = [];

	private $dashboard = [];

	private $toolbar = [];

	/**
	 * Add menu items into the admin menu
	 * @param [type] $menu      array of container menu item information
	 * @param string $namespace default location
	 */
	public function add_menu($menu,$namespace='sidebar',$hasParent=false)
	{
		if(!array_key_exists($namespace, $this->menu))
			$this->menu[$namespace] = [];
		$parent_id = 0;
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
		if(!is_array($namespace) and is_array($this->menus)){
			if( array_key_exists($namespace,$this->menus) )
				return $this->menus[$namespace];
			return [];
		}
		return $this->menus;
	}

	function has_menus($namespace)
	{
		if(array_key_exists($namespace, $this->menus) and count($this->menus[$namespace]))
			return true;
		return false;
	}

	function getHydratedMenu($namespace,$ul_menu = false,$dropdown='navi')
	{
		$tree = null;
		if($menus = $this->get_menus($namespace)):
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

			if($ul_menu):
				return "<ul class=\"nav navbar-nav nav-{$namespace}\">".buildUlExplodedTree($tree,$dropdown)."</ul>";
			endif;
		endif;
		return $tree;
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
		return collect($this->dashboard)->sortBy('ordering')->toArray();;
	}

	public function add_to_toolbar($toolbar)
	{
		if(is_array($toolbar)):
			$bar = ['name'=>'Not given','href'=>'#'];
			if(count(array_intersect_key($bar,$toolbar))==2){
				$item = array_merge($bar,$toolbar);
				$this->toolbar[] = $item;
				return true;
			}
		endif;
		return false;
	}

	public function getToolbar($asHtml = true)
	{
		// dd($this->toolbar);
		$html = '';
		foreach($this->toolbar as $toolbar):
			$html .= "<a href=\"{$toolbar['href']}\" title=\"{$toolbar['name']}\">{$toolbar['name']}</a>";
		endforeach;
		return $html;
	}

	public function has_toolbar(){
		return count($this->toolbar) ? true : false;
	}
}