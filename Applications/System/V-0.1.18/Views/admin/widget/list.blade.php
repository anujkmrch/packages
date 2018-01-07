@extends('SystemView::admin.admin')
@section("content")
<div class="admin">
	<div class="wrapper container">
		<div class="big col-lg-12">
			@include('SystemView::admin.flash')
			@if(count($widgets))
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>{{trans("SystemLang::widget.table.head.title")}}</th>
						<th>{{trans("SystemLang::widget.table.head.slug")}}</th>
						<th>{{trans("SystemLang::widget.table.head.path")}}</th>
						<th>{{trans("SystemLang::widget.table.head.id")}}</th>
						<th>{{trans("SystemLang::widget.table.head.action")}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($widgets as $widget)
					<tr>
						<td>{{$widget->title}}</td>
						<td>{{$widget->slug}}</td>
						<td>{{$widget->path}}</td>
						<td>{{$widget->id}}</td>
						<td class="action">
							<a href="{{route('admin.widget.create',['slug'=>$widget->slug])}}" class="link">
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
