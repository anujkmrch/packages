@extends('SystemView::admin.admin')
@section('content')
<div class="admin">
	<div class="wrapper container">
		<div class="row">
			<div class="col-lg-12">
				<form action="{{route('dsvv.admin.course.single',['code'=>$course->code])}}" method="post">
					{{csrf_field()}}

					@php
						
						$form = new \System\Classes\FormBuilder($course->buildCourseFormElement())
					@endphp
					
					{!!$form->build()!!}
					<div class="form-group fc-grp">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection