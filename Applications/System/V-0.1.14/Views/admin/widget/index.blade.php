@extends('SystemView::admin.admin')
@section("content")
<div class="admin">
	<div class="wrapper">
		<div class="small">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>
			<div class="button margin10"><a href="{{route('admin.widget.index')}}" class="btn btn-block btn-default">Create new widget</a></div>
			{{-- @if(count($widgets))
				@foreach($widgets as $widget)
				<div class="widget margin10">
					<h3 class="title">{{$widget->title}}</h3>
					<a class="btn btn-sm btn-primary" href="{{route('admin.widget.assign',['id'=>$widget->id])}}"><i class="fa fa-plus"></i>	Assign me now</a>
				</div>
				@endforeach
			@endif --}}
		</div>
		<div class="big">
			@include('SystemView::admin.flash')
			@if(count($widgets))
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>{{trans("SystemLang::widget.table.head.title")}}</th>
						<th>{{trans("SystemLang::widget.table.head.slug")}}</th>
						<th>{{trans("SystemLang::widget.table.head.id")}}</th>
						<th>{{trans("SystemLang::widget.table.head.action")}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($widgets as $widget)
					<tr>
						<td>{{$widget->widget->title}}</td>
						<td>{{$widget->widget->slug}}</td>
						<td>{{$widget->id}}</td>
						<td class="action">
							<a href="{{route('admin.widget.edit',['widget'=>$widget->id])}}" class="link">
								<i class="fa fa-edit"></i> Edit
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
