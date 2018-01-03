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
							<th>Session</th>
							<th>Total courses</th>
						</tr>
					</thead>
					<tbody>
						@foreach($courses as $course)
						<tr>
							<td>{{$course->id}}</td>
							<td><a href="{{route('dsvv.admin.session.single',['id'=>$course->id])}}">{{$course->title}}</a></td>
							<td>{{$course->courses->count()}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection