@extends('SystemView::admin.admin')
@section("content")
<div class="admin access">
	<div class="wrapper">
		<div class="permission">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.access.create.role')}}" class="btn btn-block btn-default">Create new role</a></div>
			<form action="{{route('admin.access.create.permission')}}" method="POST" role="form">
				{{csrf_field()}}
				<legend><i class="fa fa-plus-square"></i> Create new permission</legend>
				<div class="fc-grp">
					<label for="">Permission name</label>
					<input type="text" name="permission[title]"  class="fc-in" id="" placeholder="Enter name">
				</div>
				<div class="fc-grp">
					<label for="">Permission key</label>
					<input type="text" name="permission[slug]" class="fc-in" id="" placeholder="Enter key">
				</div>

				<div class="fc-grp">
					<label for="">Default Access</label>
					<select name="permission[_default]" class="fc-select" required="">
						<option value="deny">Deny</option>
						<option value="allow">Allow</option>
					</select>
				</div>
				<button type="submit" class="btn col-def">Create</button>
			</form>
		</div>
		<div class="roles">
			@include('SystemView::admin.flash')
			@if(count($roles))
				<table class="table striped hovered">
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
			<table class="table striped hovered bordered">
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