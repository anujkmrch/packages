@extends('DevView::Admin.admin')
@section("content")
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.access.index')}}" class="btn btn-block btn-default">Go back</a></div>
		</div>
		<div class="col-lg-9">
			@include('DevView::Admin.flash')
			<form action="{{route('admin.access.role',['role'=>$role->slug])}}" method="POST" role="form">
				{{csrf_field()}}
				<div class="row">
					<div class="col-lg-4">
						<h3>Role: {{$role->title}}</h3>
						<div class="form-group">
							<label for="">Title</label>
							<input name="title" type="text" class="form-control" id="" placeholder="Rolename" value="{{$role->title}}">
						</div>

						<div class="form-group">
							<label for="">Slug</label>
							<input name="slug" type="text" class="form-control" id="" placeholder="Rolename" value="{{$role->slug}}">
						</div>

						<div class="form-group">
							<label for="">Enable</label>
							<div class="radio">
								<label>
									<input type="radio" name="enabled" value="1"{{$role->enabled?' checked="true"':''}}>
									Yes
								</label>
								<label>
									<input type="radio" name="enabled" value="0"{{!$role->enabled?' checked="true"':''}}>
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
										<th>Name</th>
										<th>Key</th>
										<th>Defalut</th>
										<th>Permission</th>
									</tr>
								</thead>
								<tbody>
									@foreach($permissions as $key => $permission)
										<tr>
											<td>{{$permission->title}}</td>
											<td>{{$permission->slug}}</td>
											<td>{{ ucfirst($permission->_default) }}</td>
											<td>
												@php $current = $role->permissions->where('slug', $permission->slug)->first() @endphp
												<input type="hidden" name="permission[{{$key}}][name]" value="{{$permission->slug}}">
												<select name="permission[{{$key}}][permission]" id="input" class="form-control" required="required">
													@if(!is_null($current))
														<option{{(!is_null($current) && $current->pivot->permission === "deny") ? " selected" : '' }} value="deny">Deny</option>
														<option value="allow" {{(!is_null($current) and $current->pivot->permission === "allow") ? " selected" : ''}}>Allow</option>
														<option value="inherit" {{(!is_null($current) and $current->pivot->permission === "inherit") ? " selected" : ''}}>Inherit</option>
													@else
														{{-- Case when there is no permission found --}}
														<option value="deny">Deny</option>
														<option value="allow">Allow</option>
														<option value="inherit" selected>Inherit</option>
													@endif
												</select>
											</td>
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