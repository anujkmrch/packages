<?php
	namespace System\Classes;
	class Node
	{
		private $name;
		private $title;
		private $href;
		private $slug;
		private $parent = null;
		private $ordering = 0;
		private $childrens = [];

		public function  __construct(array $info)
		{
			$keys = ['name','title','href','slug'];
			if(count(array_intersect(array_keys($info),$keys))==4):
				$this->name = $info['name'];
				$this->title = $info['title'];
				$this->href = $info['href'];
				$this->slug = $info['slug'];
			endif;
			$this->ordering = array_key_exists('ordering', $info) ? $info['ordering'] : 0;
		}

		public function addChild(System\Classes\Node $node)
		{
			$this->children = &$node;
			$node->parent = &$this;
			return $node;
		}

		public function getParent()
		{
			return $this->parent;
		}

		public function getArraySub()
		{

		}
	}
?>