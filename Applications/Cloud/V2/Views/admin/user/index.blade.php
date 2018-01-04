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
							<th>Email</th>
							<th>Total Files</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{$user->id}}</td>
							<td>{{$user->username}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->files->count()}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection