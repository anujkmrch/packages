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
							<th>Username</th>
							<th>File Name</th>
							<th>File Size</th>
						</tr>
					</thead>
					<tbody>
						@foreach($files as $file)
						<tr>
							<td>{{$file->id}}</td>
							<td><a href="{{route('cloud.admin.user.single',['id'=>$file->user->username])}}">{{$file->user->username}}</a></td>
							<td>{{$file->name}}</td>
							<td>{{$file->path}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection