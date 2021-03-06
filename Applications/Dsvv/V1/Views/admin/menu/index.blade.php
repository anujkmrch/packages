@extends('SystemView::admin.admin')
@section('content')
<div class="admin menu">
	<div class="wrapper">
		<div class="small">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-default">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.menu.create')}}" class="btn btn-block btn-default">Create new menu</a></div>
		</div>
		<div class="big">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Slug</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($menus as $menu)
					<tr>
						<td>{{$menu->title}}</td>
						<td>{{$menu->slug}}</td>
						<td><a href="{{route('admin.menu.items',['menu'=>$menu->slug])}}"><i class="fa fa-gear"></i> Manage</a>  <a href="{{route('admin.menu.trash.all',['type'=>$menu->slug])}}"><i class="fa fa-trash"></i> Delete</a> </td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection