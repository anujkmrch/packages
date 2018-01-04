<?php

if(!function_exists('dsvv_extract_course_id')):
	function dsvv_extract_course_id()
	{

	}
endif;


if(!function_exists('dsvv_extract_course_title')):
	function dsvv_extract_course_title()
	{

	}
endif;


if(!function_exists('dsvv_extract_course_code')):
	function dsvv_extract_course_code()
	{

	}
endif;


if(!function_exists('dsvv_extract_course_session_list')):
	function dsvv_extract_course_session_list()
	{
		return \Dsvv\Models\CourseSession::get()->pluck('title','id')->toArray();
		return [1=>'2017-18'];
	}
endif;

if(!function_exists('dsvv_extract_course_status')):
	function dsvv_extract_course_status()
	{
		return [1=>'Enabled',0=>'Disabled'];
	}
endif;

if(!function_exists('dsvv_extract_course_requirements')):
	function dsvv_extract_course_requirements()
	{
		return ['tenth_marksheet'=>"Marksheet High school",'twevlth_marksheet'=>"Makrsheet Intermediate"];
	}
endif;
?>