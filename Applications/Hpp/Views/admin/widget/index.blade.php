@extends('SystemView::admin.admin')
@section("content")
<div class="admin">
	<div class="wrapper">
		<div class="small">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>
			<div class="button margin10"><a href="{{route('admin.widget.index')}}" class="btn btn-block btn-default">Create new widget</a></div>
			@if(count($widgets))
				@foreach($widgets as $widget)
				<div class="widget margin10">
					<h3 class="title">{{$widget->title}}</h3>
					<a class="btn btn-sm btn-primary" href="{{route('admin.widget.assign',['id'=>$widget->id])}}"><i class="fa fa-plus"></i>	Assign me now</a>
				</div>
				@endforeach
			@endif
		</div>
		<div class="big">
			@include('SystemView::admin.flash')
			@if(count($widgets))
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>Permission Name</th>
						<th>Key</th>
						<th>Page (Slug / ID)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($widgets as $widget)
					<tr>
						<td>{{$widget->title}}</td>
						<td>{{$widget->slug}}</td>
						<td>{{$widget->menus->first()->title}} / {{$widget->menus->first()->id}}</td>
						<td class="action">
							<a href="{{route('admin.widget.edit',['widget'=>$widget->menus()->first()->pivot->id])}}" class="link">
								<i class="fa fa-edit"></i> Edit
							</a>
							<a href="{{route('admin.widget.unassign',['widget'=>$widget->menus()->first()->pivot->id])}}" class="link">
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
