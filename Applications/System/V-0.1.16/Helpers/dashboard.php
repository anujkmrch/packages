<?php

if(!function_exists('total_registered_users')):
	function total_registered_users($dashcard){
		$html = "<div class=\"dashcard\">
            <div class=\"title\">{$dashcard['title']}</div>
            <div class=\"content\">Content</div>
        </div>";
		return $html;
	}
endif;

if(!function_exists('tracker_data')):
	function tracker_data($dashcard)
	{
		$html = "<div class=\"dashcard\">
            <div class=\"title\">{$dashcard['title']}</div>
            <div class=\"content\">
            <h1>Total slugs visited so far</h1>
            </div>
        </div>";
		return $html;
	}
endif;
?>