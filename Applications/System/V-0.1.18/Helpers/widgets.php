<?php

function widget_render($position)
{

	if(is_null($position) or empty($position))
		return;
	$html = '';
	//$html = '<div id="'.$position.'"><div class="overlay"><div class="wrapper">';
	$widgets = System::getCurrentMenuWidget($position);

	ob_start();
	foreach($widgets as $widget)
	{
		$path = WIDGET_PATH.DS.$widget->path.DS.$widget->slug.DS.$widget->slug.'.php';
		if(file_exists($path))
		{
			require($path);
		}
	}
	$html .= ob_get_contents();
	//$html .="</div></div></div>";
	ob_end_clean();
	return $html;
}

function position_has_widget($position)
{
	return count(System::getCurrentMenuWidget($position)) > 0 ? true : false;
}

function widget_option_to_form($options)
{
	if(!is_array($options))
	{
		return;
	}
	// convert the widget option into form
	return;
}

function widget_form_to_configuration($form)
{
	if(!is_array($data))
	{
		return;
	}
	// convert the form data into the configration array
	return;
}

if(!function_exists('widget_true_false_options'))
{
	function widget_true_false_options()
	{
		return ['1' => "Yes",'0' => 'No'];
	}
}


?>
