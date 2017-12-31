<?php
	//dd(serialize(['event' => 'belongsto']));
	// dd(serialize(['ticket' => 'hasmany','speaker' => 'hasmany' ]));

	/**
	 * [content_generate_slug generates the slug for different content type, well most of the content type will get the ticket type]
	 * @param  [type] $text [description]
	 * @return [type]       [description]
	 */
	function content_generate_slug($text,$options = array()){
		if(isset($options['route']) and strtolower($options['route']) === 'random'){
			return $text.str_random('32');
			}
		return str_slug($text);
	}

	/**
	 * [content_string_options_to_array description]
	 * @return [type] [description]
	 */
	function content_string_options_to_array($data){
		return ((strlen($data) && is_string($data)) ? unserialize($data) : []);
	}

	/**
	 * [content_array_options_to_string description]
	 * @return [type] [description]
	 */
	function content_array_options_to_string(){
		return serialize(['tickets' => 'hasmany' ]);
	}

	/**
	 * [parse_content_relationship description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function content_parse_relationship($data){
		$event = ['ticket' => ['relation' => 'hasmany','include' => false ]];
		$ticket = ['order' => ['relation' => 'hasone', 'include' => false],'event'=>['relation' =>'belongsto','include' => true]];
		$order = ['ticket' => ['relation' => 'belongsto','include' => false],'user' => ['relation' => 'belongsto','include' => true ]];
	}

	/**
	 * [content_create_relationship_to_array description]
	 * @param  [string] $data [description]
	 * @return [array]       [description]
	 */
	function content_create_relationship_to_array($data){

	}
	
	/**
	 * [content_create_relationship_to_string description]
	 * @param  [array/object] $data [description]
	 * @return [string]       [description]
	 */
	function content_create_relationship_to_string($data){ 
		
	}

	/**
	 * [add_relationship_to_content description]
	 * @param [array] $data [description]
	 * @param [array] $new  [description]
	 * @return [array]       [description]
	 */
	function add_relationship_to_content($data,$new){

	}

	/**
	 * [delete_relationship_to_content description]
	 * @param  [array] $data [description]
	 * @param  [string] $key  [description]
	 * @return [array]       [description]
	 */
	function delete_relationship_to_content($data,$key){

	}	

	function content_fetch_method_map($method){
		switch(strtolower($method)){
			case 'hasmany':
				return 'get';
			break;
			case 'hasone':
				return 'first';
			break;
			case 'belongsto':
				return 'first';
			break;
			default:
				return null;
		}
	}

	/**
	 * Creates metaBox for admin_interface from database to html,
	 * Keyword metaBox is taken from wordpress framework, 
	 * it loads the content from content type
	 * @param  array $data [description]
	 * @return html       [description]
	 */
	function content_options_to_html_form($data){
		$return = null;
		if(is_array($data)){
			foreach($data as $key => $option){
				
			}

		}
	}

	/**
	 * Create database ready, array or string from requested html input
	 * @param  array $data [description]
	 * @return string        [description]
	 */
	function content_html_from_to_options($data){

	}

	function content_relation_keywords($keyword){
		static $keywords;
		if(!is_array($keywords)){
			$keywords = ['hasmany' => 'Has Many','belongsto' => 'Belongs to','hasone' => 'Has One', 'belongstomany' => 'Belongs to many'];
		}
		if(array_key_exists($keyword, $keywords))
			return $keywords[$keyword];
		return null;
	}

	function content_generate_meta_featured_image($meta,$key,$value=null){
		$return = '<a class="btn btn-primary" id="featured_image_insert">Insert From Media</a>';
		
		$return .= '<a class="btn btn-primary" id="featured_image_upload">Upload from system</a>';

		if($value){
			$return .='<div class="thumbnail"><img src="/'.$value.'" class="img-responsive"/></div>';
			//$return .='<div class="thumbnail">'.$value.'</div>';
		}



		$return .= '<input type="hidden" name="meta[featured_image]" id="meta_'.$key.'" value="'.$value.'" />';

		return $return;
	}

	function content_generate_meta_support_layouts($selected){
		$return = '<div class="form-group">
						<label for="">Support_layout</label>
						<select name="meta[support_layout]" id="input" class="form-control" required="required">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Layout</label>
						<select name="meta[layout]" id="input" class="form-control" required="required">
							';
							if($layouts = config('webodeci.layouts'))
							foreach($layouts as $value => $option)
								$return .= '<option value="'.$value.'">'.$option.'</option>';
						$return .= '</select>
					</div>';
		return $return;
	}
	function content_generate_meta_font_awesome_icons($meta,$key,$value){
		$return = '<div class="form-group">
						<label for="">Has Font Awesome Icon</label>
						<select name="meta[font_awesome_icons]" id="input" class="form-control" required="required">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>';

	}

	function content_generate_meta($meta,$key,$value=null){
		$type = 'content_generate_meta_'.$meta['type'];
		if(function_exists($type))
			return $type($meta,$key,$value);
		
		return $return;
	}
	
	/**
	 * generate the input text box
	 * @param  array 	$meta     	array of current meta information
	 * @param  string 	$key      	meta saved key name to be created
	 * @param  string 	$selected 	previously stored value
	 * @return html           		string
	 */
	function content_generate_meta_text($meta,$key,$selected){
		$return = '<div class="form-group">
						<label for="">'.$meta["name"].'</label>
						<input type="text" name="meta['.$key.']" class="form-control" id="" value="'.$selected.'" placeholder="Enter '.$meta["name"].'">
					</div>';
		return $return;
	}
	
	/**
	 * [content_generate_meta_textarea description]
	 * @param  array 	$meta     	array of current meta information
	 * @param  string 	$key      	meta saved key name to be created
	 * @param  string 	$selected 	previously stored value
	 * @return html           		string
	 */
	function content_generate_meta_textarea($meta,$key,$selected){

	}
	
	/**
	 * [content_generate_meta_select description]
	 * @param  array 	$meta     	array of current meta information
	 * @param  string 	$key      	meta saved key name to be created
	 * @param  string 	$selected 	previously stored value
	 * @return html           		string
	 */
	function content_generate_meta_select($meta,$key,$value){
		$return = '<div class="form-group">
						<label for="">'.$meta["name"].'</label>';
					   $return.= '<select name="meta['.$key.']" id="input_'.$key.'" class="form-control" required="required">
										<option value=""';
											if(empty($value) or is_null($value))
												$return .= ' selected';
										$return .= '>None</option>';
									if(count($meta['options'])){
										foreach($meta['options'] as $opt_key => $option){
										$return .= '<option value="'.$opt_key.'"';
										if($value === $opt_key)
												$return .= ' selected';
										$return .= '>'.$option.'</option>';
										}
									}
					$return .= '</select>
							</div>';
		return $return;
	}

	function content_generate_meta_date($meta,$key,$selected){
		$return ='<div class="form-group date">
				    <label for="">'.$meta["name"].'</label>
				    <input type="text" name="meta['.$key.']" class="form-control"  value="'.$selected.'" placeholder="Enter '.$meta["name"].'">
				    <div class="input-group-addon">
				        <span class="glyphicon glyphicon-th"></span>
				    </div>
				</div>';
		return $return;
	}

	/**
	 * [content_generate_meta_select_multiple description]
	 * @param  array 	$meta     	array of current meta information
	 * @param  string 	$key      	meta saved key name to be created
	 * @param  string 	$selected 	previously stored value
	 * @return html           		string
	 */
	function content_generate_meta_select_multiple($meta,$key,$selected){

	}
	
	/**
	 * [content_generate_meta_select_checkbox description]
	 * @param  array 	$meta     	array of current meta information
	 * @param  string 	$key      	meta saved key name to be created
	 * @param  string 	$selected 	previously stored value
	 * @return html           		string
	 */
	function content_generate_meta_checkbox($meta,$key,$selected){

	}

	/**
	 * [content_generate_meta_radio description]
	 * @param  [type] $meta     [description]
	 * @param  [type] $key      [description]
	 * @param  [type] $selected [description]
	 * @return [type]           [description]
	 */
	function content_generate_meta_radio($meta,$key,$selected){

	}

	/**
	 * [content_generate_meta_image description]
	 * @param  [type] $meta     [description]
	 * @param  [type] $key      [description]
	 * @param  [type] $selected [description]
	 * @return [type]           [description]
	 */
	function content_generate_meta_image($meta,$key,$selected){
		$return ='<div class="form-group">
			    <label for="">'.$meta["name"].'</label>
			    <input type="file" name="meta['.$key.']" class="form-control"  value="'.$selected.'" placeholder="Enter '.$meta["name"].'"><div class="thumbnail">';
			    if($selected)
			    	$return .= '<img src="'.$selected.'" class="img-responsive"/>';
			$return .= '</div></div>';
		return $return;
	}

	/**
	 * [content_generate_meta_file description]
	 * @param  [type] $meta     [description]
	 * @param  [type] $key      [description]
	 * @param  [type] $selected [description]
	 * @return [type]           [description]
	 */
	function content_generate_meta_file($meta,$key,$selected){
		$return ='<div class="form-group">
			    <label for="">'.$meta["name"].'</label>
			    <input type="file" name="meta['.$key.']" class="form-control"  value="'.$selected.'" placeholder="Enter '.$meta["name"].'">
			</div>';
		return $return;
	}
	
	/**
	 * [content_generate_meta_select_radio description]
	 * @param  array 	$meta     	array of current meta information
	 * @param  string 	$key      	meta saved key name to be created
	 * @param  string 	$selected 	previously stored value
	 * @return html     			string
	 */
	function content_generate_meta_select_radio($meta,$key,$selected){

	}
	
	/**
	 * [content_meta_array_to_string description]
	 * @param  array $array [description]
	 * @return string        [description]
	 */
	function content_meta_array_to_string($array){
		return $string;
	}

	/**
	 * [content_meta_string_to_array description]
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
	function content_meta_string_to_array($string){
		return $array;
	}
?>