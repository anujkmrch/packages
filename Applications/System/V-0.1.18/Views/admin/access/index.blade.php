@extends('SystemView::admin.admin')
@section("content")
<div class="admin access">
	<div class="container wrapper">
		<div class="permission col-lg-4">
			

			<form action="{{route('admin.access.create.permission')}}" method="POST" role="form">
				{{csrf_field()}}
				<legend><i class="fa fa-plus-square"></i> Create new permission</legend>
				<div class="form-group fc-grp">
					<label for="">Permission name</label>
					<input type="text" name="permission[title]"  class="form-control fc-in" id="" placeholder="Enter name">
				</div>
				<div class="form-group fc-grp">
					<label for="">Permission key</label>
					<input type="text" name="permission[slug]" class="form-control fc-in" id="" placeholder="Enter key">
				</div>

				<div class="form-group fc-grp">
					<label for="">Default Access</label>
					<select name="permission[_default]" class="form-control fc-select" required="">
						@foreach(config('system.permission',['deny'=>'Deny','allow'=>'Allow']) as $key => $name)
							<option value="{{$key}}">{{$name}}</option>
						@endforeach
					</select>
				</div>
				<button type="submit" class="btn col-def">Create</button>
			</form>
		</div>
		<div class="roles col-lg-8">
			@include('SystemView::admin.flash')
			@if(count($roles))
				<table class="table striped hovered table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Role name</th>
							<th>Role slug</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach($roles as $role)
						<tr>
							<td>{{$role->title}}</td>
							<td>{{$role->slug}}</td>
							<td class="action">
								<a href="{{route('admin.access.role',['role'=>$role->slug])}}" class="link">
									<i class="fa fa-gear"></i> Manage
								</a> 
								<a href="{{route('admin.access.trash',['role'=>$role->id])}}" class="link">
									<i class="fa fa-trash"></i> Trash
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@endif
			<hr />
			@if(count($permissions))
			<table class="table striped hovered bordered table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Permission Name</th>
						<th>Key</th>
						<th>Default</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($permissions as $permission)
					<tr>
						<td>{{$permission->title}}</td>
						<td>{{$permission->slug}}</td>
						<td>{{$permission->_default}}</td>
						<td class="action">
							<a href="{{route('admin.permission.trash',['permission'=>$permission->id])}}" class="link">
								<i class="fa fa-trash"></i> Trash
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</div>
	</div>
</div>
@endsection