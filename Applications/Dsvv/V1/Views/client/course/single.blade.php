@extends('SystemView::client.client')
@section("content")
<div class="client content">
	<div class="wrapper">
		<div class="card">
			<div class="title">
				{{$course->title}}
			</div>
			@if(\Dsvv::canIApplyForCourse())
				You're logged in
				{{\Dsvv::user()->firstname}}
			@else
				You're not logged or you do not have permission to login
				<a href="{{route('auth.login',['redirect_to' => request()->path()])}}">Please Login</a>
			@endif
		</div>
	</div>
</div>
@endsection