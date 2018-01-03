@extends('SystemView::admin.admin')
@section("content")
<div class="admin widget">
	<div class="wrapper container">
		<div class="big col-lg-12">
			<div id="featured">
				<div class="box" style="width:30%;">
		            <h1>Widget for {{$widget->widget->title}}</h1>
		        </div>
		        @php
				$form = new \System\Classes\FormBuilder($widget->renderingConfiguration());
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
