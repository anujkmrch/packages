@extends('SystemView::admin.admin')
@section('content')
<div class="admin">
	<div class="wrapper container">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover table-bordered table-striped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Code</th>
							<th>Title</th>
							<th>Session</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($courses as $course)
						<tr>
							<td>{{$course->id}}</td>
							<td><a href="{{route('dsvv.admin.course.single',['code'=>$course->code])}}">{{$course->code}}</a></td>
							<td>{{$course->title}}</td>
							<td>{{$course->session->title}}</td>
							<td>{{$course->enabled? 'Enabled' : 'Disabled'}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection