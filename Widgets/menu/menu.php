<?php
$menu_name = $widget->getConfiguration('menu');
if(menu_has_items($menu_name)):
	echo "<ul class=\"nav navbar-nav {$widget->position}\">".load_menu($menu_name)."</ul>";
endif;
?>
