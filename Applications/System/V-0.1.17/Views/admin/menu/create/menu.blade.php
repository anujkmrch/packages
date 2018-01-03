@extends('SystemView::admin.admin')
@section("content")
<div class="admin menu">
	<div class="wrapper container">
		<div class="big col-lg-12">
			<form action="{{route('admin.menu.create')}}" method="POST" role="form">
				{{csrf_field()}}
				<legend>Create new menu</legend>
				<div class="fc-grp form-group">
					<label>Title</label>
					<input name="title" type="text" class="fc-in form-control" id="" placeholder="Enter title">
				</div>
				
				<div class="fc-grp">
					<label for="">Slug</label>
					<input name="slug" type="text" class="fc-in form-control" id="" placeholder="Enter menu slug">
				</div>

				<div class="form-group">
					<label for="">For</label>
					<select name="app" class="fc-select form-control">
						{{-- $options = $schema['app']['options'] --}}
						@php($options = Config::get('menu.app',['admin','client','api']))
						@foreach($options as $option)
						<option value="{{$option}}"{{config('menu.default','api')===$option ? ' selected':''}}>{{@trans('SystemLang::menu.app.'.$option)}}</option>
						@endforeach
					</select>
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
			</form>
		</div>
	</div>
</div>
@endsection