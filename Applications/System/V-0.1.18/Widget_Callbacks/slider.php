<?php
if(!function_exists('extract_slider_head')):
	function extract_slider_head($element)
	{
		if(array_key_exists('value', $element))
			return $element['value'];
		return;
	}
endif;

if(!function_exists('extract_slider_lead')):
	function extract_slider_lead($element)
	{

	}
endif;
?>