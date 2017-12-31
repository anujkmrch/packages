@extends('SystemView::admin.admin')
@section('content')
<div class="admin menu list">
	<div class="wrapper">
		<div class="small">
			 <div class="button margin10">
			 	<a href="{{route('admin.menu.item.create',['type'=>$menus->slug])}}" class="btn btn-block btn-default">Create new item</a>
			 </div>
				 <div class="button margin10">
				 	<a href="{{route('admin.menu.index')}}" class="btn btn-block btn-primary">Go back</a>
				 </div>

			<form action="{{route('admin.user.delete')}}" method="POST" role="form" class="form">
            	{{csrf_field()}}
                <input type="hidden" name="user" value="{{$menus->id}}">
                <input type="submit" value="Delete this menus" class="btn btn-block btn-default margin10">
            </form>
		</div>
		<div class="big">
			<div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <p class="alert alert-{{ $msg }}"><i class="fa fa-coffee"></i> {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
            </div>
			<table class="table striped hovered bordered">
			<thead>
				<tr>
					<th>Key</th>
					<th>Slug</th>
					<th>Application Space</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($menus->menus as $menu)
				<tr>
					<td>{{$menu->title}}</td>
					<td>{{$menu->slug}}</td>
					<td>{{@trans('SystemLang::menu.app.'.$menus->app)}}</td>
					<td>
						<a href="{{route('admin.menu.item',['type'=>$menu->type->slug, 'id' => $menu->id])}}"><i class=" fa fa-gear"></i> Manage</a>

						<a href="{{route('admin.menu.trash',['type'=>$menu->type->slug, 'id' => $menu->id])}}"><i class=" fa fa-trash"></i> Trash</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
			{{-- @foreach($menus->menus as $menu)
			<div class="accordion to-animate">
				<div class="accordion-head">
					<div class="links pull-right">
						<a href="{{route('admin.menu.item',['type'=>$menu->type->slug, 'id' => $menu->id])}}" class="accordion-toggle js-accordion-toggle"><i class=" fa fa-gear"></i> Manage</a>	
						
						<a href="{{route('admin.menu.trash',['type'=>$menu->type->slug, 'id' => $menu->id])}}"" class="accordion-toggle js-accordion-toggle"><i class=" fa fa-trash"></i> Trash</a>
					</div>
					<h3>{{$menu->title}}</h3>
					<span class="event-meta">Key {!!"&rarr;"!!} {{$menu->slug}} | Site view {!!"&rarr;"!!} {{ ucfirst($menus->for) }}</span>
				</div>
			</div>
			<!-- END .accordion -->
			@endforeach --}}
		</div>
	</div>
</div>
@endsection