@extends('SystemView::client.client')
@section("content")
<div class="container wrapper">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<table class="table table-hover hovered striped" border="1" cellpadding="2" cellspacing="0" style="margin-top:2em; width:100%; text-align: center">
				<thead>
					<tr>
						<th>File Id</th>
						<th>File Name</th>
						<th>File Path</th>
						<th>File Hits</th>
					</tr>
				</thead>
				<tbody>
					@foreach($user->files as $file)
					<tr>
						<td>{{$file->id}}</td>
						<td>{{$file->name}}</td>
						<td>{{$file->path}}</td>
						<td>{{$file->hits}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection