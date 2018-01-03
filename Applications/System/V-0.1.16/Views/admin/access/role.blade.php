@extends('SystemView::admin.admin')
@section("content")
<div class="admin access">
	<div class="container wrapper">
		<div class="small col-lg-4">
			

			<div class="full">
						<h1>Role: {{$role->title}}</h1>
						<div class="form-group fc-grp">
							<label for="">Title</label>
							<input name="title" type="text" class="form-control fc-in" id="" placeholder="Rolename" value="{{$role->title}}">
						</div>

						<div class="fc-grp form-group">
							<label for="">Slug</label>
							<input name="slug" type="text" class="form-control fc-in" id="" placeholder="Rolename" readonly="true" value="{{$role->slug}}">
						</div>

						<div class="fc-grp form-group">
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

		</div>
		<div class="big col-lg-8">
			@include('SystemView::admin.flash')
			<form action="{{route('admin.access.role',['role'=>$role->slug])}}" method="POST" role="form" class="form">
				{{csrf_field()}}
				<div class="row">
					
					<div class="full">
						<h1>Manage role's permissions</h1>
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
												<select name="permission[{{$key}}][permission]" id="input" class="fc-select form-control" required="required">
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