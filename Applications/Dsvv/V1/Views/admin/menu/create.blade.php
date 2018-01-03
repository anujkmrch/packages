@extends('DevView::Admin.admin')
@section("content")
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-default">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.menu.items',['menu'=>$type->slug])}}" class="btn btn-block btn-primary">Go back</a></div>

		</div>
		<div class="col-lg-9">
			<div class="row">
						<div class="col-md-12">
							<div class="accordion-wrap">
								<form action="" method="POST" role="form">
									<input type="hidden" name="_token" value="{{csrf_token()}}">

									<input type="hidden" name="menu_type_id" value="{{$type->id}}">			
									<div class="form-group">
										<label for="">Title</label>
										<input type="text" name="title" class="form-control" id="" placeholder="Title">
									</div>

									<div class="form-group">
										<label for="">Slug</label>
										<input type="text" name="slug" class="form-control" id="" placeholder="Slug">
									</div>
									<div class="form-group">
										<label for="">Parent</label>
										@if(count($type->menus))
								 			@php $m = $type->menus->toTree(); @endphp
								 				{!! "<select name=\"parent_id\" class=\"form-control\">"!!}
								 					<option value="0">Root</option>
								 				{!! menu_select($m,'-','id',false,0,0) !!}
								 				{!! "</select>" !!}
								 		@endif

							 		</div>
									<div class="form-group">
										<label for="">Route</label>
										<input type="text" name="route" class="form-control" id="" placeholder="Route">
									</div>

									<div class="form-group">
										<label for="">Route Options</label>
										<input type="text" name="route_options" class="form-control" id="" placeholder="Route">
									</div>

									<div class="form-group">
										<label for="">Order</label>
										<input type="text" name="ordering" class="form-control" id="" placeholder="Order" value="0">
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
									<button type="submit" class="button button-style">Submit</button>
								</form>
							</div>
						</div>
					</div>
					
		</div>
	</div>
</div>
@endsection