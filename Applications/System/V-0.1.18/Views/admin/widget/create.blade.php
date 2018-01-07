@extends('SystemView::admin.admin')
@section("content")
<div class="admin widget">
	<div class="container wrapper">
		<div class="col-lg-12">
			@php
				$contact_form = array(
				  'name' => array(
				    'title' => 'Name',
				    'type' => 'text',
				    'validations' => array('not_empty'),
				    'callback' => 'contact_widget_builder'
				  ),
				  'email' => array(
				    'title' => 'Email',
				    'type' => 'email',
				    'validations' => array('not_empty', 'is_valid_email'),
				  ),
				  'comment' => array(
				    'title' => 'Comments',
				    'type' => 'textarea',
				    'validations' => array('not_empty'),
				  ),
				  'menus' => array(
				    'title' => 'Choose to show on menu',
				    'type' => 'select',
				    'validations' => array('not_empty'),
				    'callback' => 'menu_item_build',
				    'multiple' => true,
				  ),
				  'submit' => array(
				    'title' => 'Submit me!',
				    'type' => 'submit',
				  ),
				);
				$contact_form =
				[
					'title'      => [
						'title' => 'Title',
				    	'type' => 'text',
				    	'validations' => array('not_empty'),
				    ],
				    'menu' => [
					    'title' => 'Select menu',
					    'type' => 'select',
					    'validations' => array('not_empty'),
					    'callback' => 'menu_list_build',
					    'multiple' => false,
					    'required'  => true,
					  ],
					'position' => [
					    'title' => 'Position',
					    'type' => 'select',
					    'validations' => array('not_empty'),
					    'callback' => 'position_list_build',
					    'multiple' => false,
					    'required'  => true,
					  ],
					'show' => [
					    'title' => 'Choose to show on menu',
					    'type' => 'select',
					    'validations' => array('not_empty'),
					    'callback' => 'menu_item_build',
					    'multiple' => true,
					  ],
					  'submit' => [
						    'title' => 'Submit me!',
						    'type' => 'submit',
						],
				];
				$form = new \System\Classes\FormBuilder($widget->formConfiguration());
			@endphp
<form method="post" action="{{route('admin.widget.create',['slug'=>$widget->slug])}}">
				{{csrf_field()}}
			{!!$form->build()!!}
			<input type="submit" class="fc-btn" value="Submit">
			</form>			
		</div>
	</div>
</div>
@endsection
