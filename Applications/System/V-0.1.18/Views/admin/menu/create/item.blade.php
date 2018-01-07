@extends('SystemView::admin.admin')
@section("content")
<div class="admin menu create">
	<div class="wrapper container">
		<div class="big col-lg-12">
			<form action="" method="POST" class="form" role="form">
				<input type="hidden" name="_token" value="{{csrf_token()}}">

				<input type="hidden" name="menu_type_id" value="{{$type->id}}">			
				<div class="fc-grp fc-group">
					<label for="">Title</label>
					<input type="text" name="title" class="fc-in form-control" id="" placeholder="Title">
				</div>

				<div class="fc-grp form-group">
					<label for="">Slug</label>
					<input type="text" name="slug" class="fc-in form-control" id="" placeholder="Slug">
				</div>
				<div class="fc-grp form-group">
					<label for="">Parent</label>
					@if(count($type->menus))
			 			@php $m = $type->menus->toTree(); @endphp
			 				{!! "<select name=\"parent_id\" class=\"fc-in form-control\">"!!}
			 					<option value="0">Root</option>
			 				{!! menu_select($m,'-','id',false,0,0) !!}
			 				{!! "</select>" !!}
			 		@endif
		 		</div>
		 		<div class="fc-grp form-group">
					<label for="">Visible to</label>
					<select name="roles[]" id="inputRoles" class="fc-in form-control chosen-select" required="required" multiple>
						@foreach($roles as $role)
							<option value="{{ $role->id }}">{{$role->title}}</option>
						@endforeach
					</select>
				</div>
				<div class="fc-grp form-group">
					<label for="">Route</label>
					<input type="text" name="route" class="fc-in form-control" id="" placeholder="Route">
				</div>

				<div class="fc-grp form-group">
					<label for="">Route Options</label>
					<input type="text" name="route_options" class="fc-in form-control" id="" placeholder="Route">
				</div>

				<div class="fc-grp form-group">
					<label for="">Order</label>
					<input type="text" name="ordering" class="fc-in form-control" id="" placeholder="Order" value="0">
				</div>
				<div class="fc-grp">
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
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
					
		</div>
	</div>
</div>
@endsection