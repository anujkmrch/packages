<?php
// $menu_name = $widget->getConfiguration('menu');
// if(menu_has_items($menu_name)):
	// echo "<ul class=\"nav navbar-nav {$widget->position}\">".load_menu($menu_name)."</ul>";
// endif;
?>
<?php if($widget->hasConfiguration('show_title') and $widget->getConfiguration('show_title')): ?>
	<div class="title"><?php echo $widget->title ?></div>
<?php endif; ?>

<?php if($widget->hasConfiguration('head') and !empty($head = $widget->getConfiguration('head'))): ?>
	<div class="head"><?php echo $head ?></div>
<?php endif; ?>

<?php if($widget->hasConfiguration('lead') and !empty($lead = $widget->getConfiguration('lead'))): ?>
	<div class="lead"><?php echo $lead ?></div>
<?php endif; ?>

<?php if($widget->hasConfiguration('button_1_text') and !empty($text = $widget->getConfiguration('button_1_text')) and $widget->hasConfiguration('button_1_url') and !empty($url = $widget->getConfiguration('button_1_url'))): ?>
	<a href="<?php echo $url ?>" class="btn btn-primary"><?php echo $text ?></a>
<?php endif; ?>

<?php if($widget->hasConfiguration('button_2_text') and !empty($text = $widget->getConfiguration('button_2_text')) and $widget->hasConfiguration('button_2_url') and !empty($url = $widget->getConfiguration('button_2_url'))): ?>
	<a href="<?php echo $url ?>" class="btn btn-default"><?php echo $text ?></a>
<?php endif; ?>

<?php

$c = [
		'button_1_text' => [
		    'title' => 'Button 1 Text',
		    'type' => 'text',
		    'callback' => 'widget_slider_button_text',
		    'scope' => 'configuration',
		    'multiple' => false,
		    'required'  => true,
		],

		'button_1_url' => [
		    'title' => 'Button 1 url',
		    'type' => 'text',
		    'validations' => array('not_empty'),
		    'callback' => 'widget_slider_button_url',
		    'scope' => 'configuration',
		    'multiple' => false,
		    'required'  => true,
		],

		'button_2_text' => [
		    'title' => 'Button 2 Text',
		    'type' => 'text',
		    'callback' => 'widget_slider_button_text',
		    'scope' => 'configuration',
		    'multiple' => false,
		    'required'  => true,
		],

		'button_2_url' => [
		    'title' => 'Button 2 url',
		    'type' => 'text',
		    'validations' => array('not_empty'),
		    'callback' => 'widget_slider_button_url',
		    'scope' => 'configuration',
		    'multiple' => false,
		    'required'  => true,
		],

	];
	// $cf = array_merge($widget->widget->configuration,$c);
	// echo json_encode($cf);
?>