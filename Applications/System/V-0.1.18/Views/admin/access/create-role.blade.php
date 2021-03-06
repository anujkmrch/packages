@extends('SystemView::admin.admin')
@section("content")
<div class="admin access">
	<div class="container wrapper">
		<div class="small col-lg-4">
			<form action="{{route('admin.access.create.role')}}" method="POST" role="form">
				{{csrf_field()}}
				<div class="role">
						<h3>Create new role</h3>
						<div class="form-group fc-grp">
							<label for="">Title</label>
							<input name="role[title]" type="text" class="form-control fc-in" id="" placeholder="Rolename" value="">
						</div>

						<div class="form-group fc-grp">
							<label for="">Slug</label>
							<input name="role[slug]" type="text" class="form-control fc-in" id="" placeholder="Rolename" value="">
						</div>

						<div class="form-group fc-grp">
							<label for="">Enable</label>
							<div class="radio">
								<label>
									<input type="radio" name="role[enabled]" value="1">
									Yes
								</label>
								<label>
									<input type="radio" name="role[enabled]" value="0" checked="true">
									No
								</label>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
			
		</div>
		<div class="big col-lg-8">

				@include('SystemView::admin.flash')
				
				<div class="row">
					
					<div class="permissions">
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
												<input type="hidden" name="permission[{{$key}}][name]" value="{{$permission->slug}}">
												<select name="permission[{{$key}}][permission]" id="input" class="form-control fc-select" required="required">
													<option value="deny">Deny</option>
													<option value="allow">Allow</option>
													<option value="inherit" selected>Inherit</option>
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