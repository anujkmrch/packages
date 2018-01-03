<?php

return [
	'course'=>[
		'id' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'scope' => 'column', //{column, relation, configuration}//
		   	'callback' => 'extract_widget_title',
		   	'validations' => array('not_empty'),
		],
		'title' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'scope' => 'column', //{column, relation, configuration}//
		],
		'code' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'scope' => 'column', //{column, relation, configuration}//
		],
		
		'course_session_id' => [
			'title' => 'Title',
		   	'type' => 'text',
		   	'scope' => 'column', //{column, relation, configuration}//
		   	'callback' => 'extract_course_session_list',
		],

		'enabled' => [
			'title' => 'Title',
		   	'type' => 'radio',
		   	'scope' => 'column', //{column, relation, configuration}//
		   	'callback' => 'extract_widget_title',
		],
	],
];
?>