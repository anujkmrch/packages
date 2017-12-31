@extends('DevView::Admin.admin')
@section("content")
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.access.index')}}" class="btn btn-block btn-default">Go back</a></div>

		</div>
		<div class="col-lg-9">
			<form action="{{route('admin.access.create')}}" method="POST" role="form">
				{{csrf_field()}}
				<div class="row">
					<div class="col-lg-4">
						<h3>Creating roles</h3>
						<div class="form-group">
							<label for="">Title</label>
							<input type="text" class="form-control" id="" placeholder="Rolename">
						</div>

						<div class="form-group">
							<label for="">Slug</label>
							<input type="text" class="form-control" id="" placeholder="Rolename">
						</div>

						<div class="form-group">
							<label for="">Enable</label>
							<div class="radio">
								<label>
									<input type="radio" name="enabled" value="1">
									Yes
								</label>
								<label>
									<input type="radio" name="enabled" value="0" checked="true">
									No
								</label>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<div class="col-lg-8">
						<h3>Manage role's permissions</h3>
						@if(count($permissions))
							<table class="table table-hover table-bordered table-striped">
								<thead>
									<tr>
										<th>Permission</th>
										<th>Default</th>
										<th>Access</th>
									</tr>
								</thead>
								<tbody>
								@foreach($permissions as $permission)
								<tr>
									<td>{{$permission->title}}</td>
									<td>{{$permission->title}}</td>
									<td>{{$permission->title}}</td>
								</tr>
								@endforeach
								</tbody>
							</table>
						@endif
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection