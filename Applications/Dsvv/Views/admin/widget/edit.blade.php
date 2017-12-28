@extends('DevView::Admin.admin')
@section("content")
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.widget.index')}}" class="btn btn-block btn-default">Go back</a></div>

		</div>
		<div class="col-lg-9">
			{{$widget->menus->first()->title}}
			@php print_r($widget->options) @endphp
		</div>
	</div>
</div>
@endsection
