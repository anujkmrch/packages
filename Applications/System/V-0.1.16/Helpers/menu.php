<?php

function traverse($nodes, $prefix = '-',$markup='li',$cmarkup='ul',$disable=false,$disableId=0) {
	$result = "";
    foreach ($nodes as $node) {
    	$result .= PHP_EOL."<{$markup}";
    	
    	if($disable and $node->id == $disableId)
        	$result .= " disabled=\"true\"";

        $result .= ">".$prefix.' '.$node->title ;
        
        if($node->children()->count()){
        	if(strlen($cmarkup))
        		$result .= PHP_EOL. "<{$cmarkup}>";

        	$result .= traverse($node->children, $prefix.'-',$markup,$cmarkup,$disable,$disableId);
        	if(strlen($cmarkup))
        		$result .="</{$cmarkup}>";
        }
        $result .= "</{$markup}>";
    }

    return $result;
}

function menu_has_items($name)
{
    return \System::getMenu($name) ? true : false;
}

function load_menu($name,$type='ul',$recursive=false){
   
    
    if($menu = \System::getMenu($name))
        return menu_ul( $menu->toTree(),$recursive );
    return null;
}

function menu_ul($nodes,$recursive = false,$markup='li',$markup_class='',$cmarkup='ul',$cmarkup_class= "dropdown-menu") {
	$result = "";
    foreach ($nodes as $node) {
    	$result .= PHP_EOL."<{$markup} class=\"n$markup_class";

        if($node->children()->count() and $recursive){
            if(strlen($cmarkup))
                $result .= " $cmarkup_class\"";
        } else {
           $result .= "\"";
        }
    	$slug = ( empty($node->slug) or is_null($node->slug)) ? '/' : $node->slug;
        $result .= "><a href=\"{$slug}\"";
        
        if($node->children()->count() and $recursive){
            $result .= ' class="dropdown-toggle" data-toggle="dropdown">'.$node->title.' <b class="caret"></b></a>';
        	if(strlen($cmarkup))
        		$result .= PHP_EOL. "<{$cmarkup} class=\"dropdown-ul\">";

        	$result .= menu_ul($node->children, $recursive,$markup,'',$cmarkup,$cmarkup_class);
        	
        	if(strlen($cmarkup))
        		$result .="</{$cmarkup}>";
            $result .= "</{$markup}>";
        } else{
            $result .=">{$node->title}</a>";
            $result .= "</{$markup}>";
        }
    }

    return $result;
}



function menu_select($nodes, $prefix = '-',$key='id',$disable=false,$disableId=0,$parent_id = 0) {
	$result = "";
    foreach ($nodes as $node) {
    	$result .= PHP_EOL."<option value=\"{$node->$key}\"";

    	if($parent_id and $node->id == $parent_id):
    		$result .= " selected=\"true\"";
    	endif;

    	if($disable and $node->id == $disableId)
        	$result .= " disabled=\"true\"";

        $result .= ">".$prefix.' '.$node->title ;
        
        if($node->children()->count()){
        	$result .= menu_select($node->children, $prefix.' -',$key,$disable,$disableId,$parent_id);
        }
        
        $result .= "</option>";
    }

    return $result;
}


function tr($categories, $prefix = '-') {
	$result = '';
    foreach ($categories as $category) {
        echo  PHP_EOL.$prefix.' '.$category->title;
        tr($category->children, $prefix.'-');
    }
    //return $result;
}


function admin_menu_table($categories, $prefix = '-',$menu,$slug) {
	
	$result = '';
    foreach ($categories as $item) {
        
        $result .= "<tr>
							  			<td>{$item->id}</td>
							  			<td>";
							  			for($i = 0; $i < $item->depth; $i++){ $result .= " -"; } 
							  				$result .= "{$item->title}
							  			</td>
							  			<td>{$item->slug}</td>
							  			<td>{$item->parent_id}</td>
							  			<td>{$menu}</td>
										<td><span class=\"ordering-span\">{$item->ordering} </span><a href=\"".route('admin.menus.order.up',['menu' => $slug,'id' => $item->id])."\" title=\"Order Up\"><i class=\" fa fa-arrow-up\"></i></a> | <a href=\"".route('admin.menus.order.down',['menu' => $slug,'id' => $item->id])."\" title=\"Order Down\"><i class=\"fa fa-arrow-down\"></i></a>

</td>

							  			<td><a href=\"/\" title=\"Published\"><i class=\"fa fa-newspaper-o\"></i></a> | 	
											
											<a href=\"".route('admin.menus.edit.item',['menu'=>$slug, 'id' => $item->id])."\" title=\"Edit\"><i class=\"fa fa-edit\"></i></a>
											 | 
											<a href=\"".route('admin.menus.trash.item',['menu'=>$slug, 'id' => $item->id])."\" title=\"Trash\"><i class=\"fa fa-trash\"></i></a></td>
							  		</tr>";

        $result .= admin_menu_table($item->children, $prefix.'-',$menu,$slug);
    }
    return $result;
}
?>
