@extends('SystemView::client.client')
@section("content")
<div class="client content">
	<div class="wrapper">
		@foreach($session->courses as $course)
		<div class="card">
			<div class="title">
				{{$course->title}}
			</div>
			<a href="{{route('client.course.single',['id'=>$course->id])}}" class="btn">View</a>
			<a href="{{route('client.course.checkout',['id'=>$course->id])}}">Apply now</a>
		</div>
		@endforeach
	</div>
</div>

@endsection