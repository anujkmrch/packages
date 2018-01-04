<?php
namespace Dsvv\Classes;
class CourseFormBuilder
{
	var $elements = [];

	function __construct($elements)
	{
		$this->elements = $elements;
	}

	function build($course = null)
	{
		$input = '';
		foreach($this->elements as $name => $element):
			$array = null;			
			if(array_key_exists('callback', $element) and is_callable($element['callback'])){
				$array=call_user_func_array($element['callback'],[$course]);
			}

			if(!array_key_exists('type',$element))
				continue;

			switch($element['type']):
				case 'text':
				case 'email':
				case 'password':
					$input .= $this->input($name,$element,$course,$array);
				break;

				case 'select':
					$input .= $this->select($name,$element,$course,$array);
				break;

				case 'radio':
					$input .= $this->radio($name,$element,$course,$array);
				break;

				case 'checkbox':
					$input .= $this->input($name,$element,$course,$array);
				break;
			endswitch;
		endforeach;

		return $input;
	}

	function input($name,$element,$course,$information = null)
	{
		return "<div class=\"form-group fc-in\">
					<label for=\"\">{$element['title']}</label>
					<input type=\"{$element['type']}\" class=\"form-control fc-in\" id=\"{$name}\" value=\"".($course ? $course->$name : '')."\">
				</div>";
	}

	function select($name,$element,$course,$information = null)
	{
		$input ="<div class=\"form-group fc-in\">
			<label for=\"\">{$element['title']}</label>
			<select name=\"$name\" id=\"$name\" class=\"form-control fc-in\" required=\"required\">";
				foreach($information as $value => $key):
					$input .= "<option value=\"{$value}\">{$key}</option>";
				endforeach;
			$input .= "</select></div>";
			return $input;
	}

	function radio($name,$element,$course,$information = null)
	{
		// dd($information);
		$input ="<div class=\"form-group fc-in\">
			<label for=\"\">{$element['title']}</label><div class=\"radio\">";
				foreach($information as $value => $key):
					$input.= "<label><input type=\"radio\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" checked=\"checked\"> {$key}</label> ";
				endforeach;
		$input .="</div></div>";
		return $input;
	}
}
?>