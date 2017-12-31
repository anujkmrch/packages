<?php 
/**
 * Developer: Unknown
 * Following url is the resource for this code.
 * https://gist.github.com/jmc734/3394779
 */
class Structure {
	private static $structure;
	private static $lookup;
	// Nodes can be any objects that have IDs (id) and a parent IDs (parent)
	public static function buildTree($nodes){
		// Initialize structure and lookup arrays
		self::$structure = array();
		self::$lookup = array();
		// Walk through nodes
		array_walk($nodes, 'Structure::addNode');
		// Return the hierarchical (tree) structure
		return self::$structure;
	}
	private static function addNode($obj) {
		// Convert string ids returned by PDO to integers
		$nid = (int)$obj->id;
		$pid = (int)$obj->parent;
		// Initialize child array
		$obj->children = array();
		// If top level node, set parent child array to a reference to whole structure
		if($pid === 0){
			// If top level node, set parent child array to whole structure
			$parent = &self::$structure;
		} else {
			// Else, set it to reference to the parent child array
			$parent = &self::$lookup[$pid]->children;
		}
		// Get ID of new node it child array
		$id = count($parent);
		// Add node to child array
		$parent[] = $obj;
		// Add reference to node in parent child array to the lookup table
		self::$lookup[$nid] = &$parent[$id];
	}
	/* ... */
}
?>