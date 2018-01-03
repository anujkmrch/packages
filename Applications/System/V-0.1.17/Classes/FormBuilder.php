<?php
namespace System\Classes;

/**
 * Form Class
 *
 * Responsible for building forms
 *
 * @param array $elements renderable array containing form elements
 *
 * @return void
 */
 class FormBuilder {
   
   public $elements;
   
   public $form_number = 1;

   public $classes = [
   			'label' => 'fc-lbl',
   			'input' => 'fc-in form-control',
   			'textarea' => 'fc-ta form-control',
   			'select'  => 'fc-select form-control',
   			'radio'   => 'fc-radio',
   			'checkbox' => 'fc-checkbox',
   			'input_button' => 'fc-btn',
   			'button' => 'fc-btn',
   		];

   public function __construct($elements){
     $this->elements = $elements;
   }

   /**
    * Form class method to dump object elements
    * 
    * The method just dumps the elements of the form passed to the instantiation.
    * 
    * @return void
    * 
    */

   public function dumpElements() {
     var_dump($this->elements);
   }
   
   /**
    * Form class method to build a form from an array
    * 
    * 
    * @return string $output contains the form as HTML
    * 
    */
  function build($request = null) {
    
    $output = '';
    
    // For multiple forms, create a counter.
    $this->form_number++;
    // Loop through each form element and render it.
    foreach ($this->elements as $name => $elements) {
      $value=array_key_exists('value',$elements)?$elements['value']:null;
      $label = '<label class="fc-lbl">' . $elements['title'] . '</label>';
      $information = '';
      if(
	      	array_key_exists('callback',$elements) 
	      		and 
	      	is_callable($elements['callback']) 
	      		and 
	      	array_key_exists('type',$elements) 
	      		and 
	      	is_callable(array(&$this,$elements['type']))
	      ):

      		$array = call_user_func($elements['callback'],$elements);
      		$method = $elements['type'];
      		$information .= $this->$method($array,$name,$elements,$request);
      endif;

      switch ($elements['type']) {
        case 'textarea':
          $input = "<textarea class=\"fc-in form-control\" name=\"{$name}\">{$value}</textarea>";
          break;
        case 'email':
        case 'password':
        case 'text':
        case 'number':
        case 'date':
          $input = "<input class=\"fc-in form-control\" name=\"{$name}\" type=\"{$elements['type']}\" value=\"{$value}\" />";
          break;

        case 'select':
        	$extra = '';
        	if(array_key_exists('multiple',$elements) and $elements['multiple']===true):
        		$name= $name.'[]';
        		$extra .= ' multiple="true"';
        	endif;
        	if(array_key_exists('required',$elements) and $elements['required']===true):
        		$extra .= ' required="true"';
        	endif;
        	$input = '<select class="fc-in form-control" name="' . $name . '"'.$extra.'>';
        	$input .= $information;
        	$input .= "</select>";

        break;
        
        case 'submit':
          $input = '<input type="submit" class="fc-btn btn btn-default btn-admin-form" name="' . $name . '" value="' . $elements['title'] . '">';
          $label = '';
          break;

        case 'checkbox':

        break;
        
        case 'radio':
        $input.='<div class="form-group fc-radio"><div class="radio">
            ';
            foreach($array as $key => $call ):
              $input .= "<label><input type=\"radio\" name=\"{$name}\" id=\"input\" value=\"{$key}\"> {$call}<label>";
            endforeach;
              $input .= '</div></div>';
        break;

        default:
          $input = '<input type="' . $elements['type'] . '" name="' . $name . '" />';
          break;
      }
      $output .= $label . '<p>' . $input . '</p>';
    }
    // Return the form.
    return $output;
  }

  function text($array,$name,$element=null,$request=null)
  {
  	if(is_array($request) and array_key_exists($name,$request))
  		return $request[$name];
  	return "";
  }

  function select($array,$name,$element=null,$request=null)
  {
  	$select = '';
  	
  	if(is_array($request) and array_key_exists($name,$request))
  		$select = $request[$name];

  	if(is_array($element) and array_key_exists('value',$element))
  		$select = $element['value'];

  	$html = '';

 $m = ["Login","Logout","Courses","Applications","My Profile","Sign up","Second"];
  	foreach($array as $key => $value):
  		$attribute = '';
  		
  		if($key === $select)
  			$attribute = ' selected';

  		elseif(array_key_exists('multiple',$element) 
  			and $element['multiple'] 
  			and is_array($select) 
  			and in_array($key,$select)
  		)
  			$attribute = ' selected';

  		$html .= "<option value=\"{$key}\"{$attribute}>{$value}</option>";

  	endforeach;
  	
  	return $html;
  }

  public function radio()
  {
    return "htrer";
  }
 }