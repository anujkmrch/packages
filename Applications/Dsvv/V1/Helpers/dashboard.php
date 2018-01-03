<?php

if(!function_exists('applications_status')):
	function applications_status($dashcard){
		$html = "<div class=\"dashcard\">
            <div class=\"title\">{$dashcard['title']}</div>
            <div class=\"content\">Content</div>
        </div>";
		return $html;
	}
endif;

?>