@extends('SystemView::admin.admin')
@section("content")
<div class="admin widget">
	<div class="wrapper">
		<div class="small">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.widget.index')}}" class="btn btn-block btn-default">Go back</a></div>

		</div>
		<div class="big">
			<div id="featured">
				<div class="box" style="width:30%;">
		            <div class="title">Widget for {{$widget->widget->title}}</div>
		            <div><a href="{{route('admin.widget.create',['slug'=>$widget->slug])}}" class="btn">Create new</a></div>
		        </div>
		        @php
		        $contact_form =
				[
					'title' => [
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
					'sync' => [
					    'title' => 'Choose to show on menu',
					    'type' => 'select',
					    'validations' => array('not_empty'),
					    'callback' => 'menu_item_build',
					    'multiple' => true,
					  ],
				];
				$form = new \System\Classes\FormBuilder($widget->renderingConfiguration());
				// $widget->buildForm();
			@endphp
				<form method="post" action="{{route('admin.widget.edit',['id'=>$widget->id])}}">
				{{csrf_field()}}
			{!!$form->build()!!}
			<input type="submit" class="fc-btn" value="Submit">
			</form>

				{{-- @if($widget->widget->count())
					@foreach($widget->widgetized as $widgetize)
						@php
							print_r($widgetize->renderingConfiguration());
						@endphp
						{{$widgetize->getConfiguration('menu')}}
					@endforeach
				@endif --}}
			</div>
		</div>
	</div>
</div>
@endsection
