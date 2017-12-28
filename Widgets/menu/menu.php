<?php
$menu_name = $widget->getConfiguration('menu');
if(menu_has_items($menu_name)):
	echo "<div class=\"{$widget->position} nav\"><ul class=\"list-unstyled\">".load_menu($menu_name)."</div></ul>";
endif;
?>