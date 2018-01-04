<?php
if(!function_exists('applications_status')):
	function applications_status($dashcard){
		$html = "<div class=\"dashcard\">
            <div class=\"title\">{$dashcard['title']}</div>
            <div class=\"content\">
            	<h1>This should be good and make it possible</h1>
            </div>
        </div>";
		return $html;
	}
endif;
?>