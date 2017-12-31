@extends('SystemView::admin.admin')
@section("content")
<div class="admin widget">
	<div class="wrapper">
		<div class="small">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.widget.index')}}" class="btn btn-block btn-default">Go back</a></div>

		</div>
		<div class="big">
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
			{{$widget->title}}
			<div id="featured">
				<div class="box" style="width:30%;">
		            <div class="title">New Widget</div>
		            <div class="description">Want an online presence, get a hosting account to offer you starters hosting website, static or dynamic apps ready.</div>
		            <div class="note">Annual purchase required</div>
		            <div><a href="#" class="btn">Create new</a></div>
		        </div>
				@if($widget->widgetized->count())
					{{-- @foreach($widget->widgetized as $widgetize)
						{{ $widgetize->configuration['menu_name'] }}
					@endforeach --}}
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
