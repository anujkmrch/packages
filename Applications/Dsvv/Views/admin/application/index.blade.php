@extends('DsvvView::admin.admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-primary">Frontpage</a></div>

			<div class="button margin10"><a href="{{route('admin.application.newonly')}}" class="btn btn-block btn-default">New Applications</a></div>

			<div class="button margin10"><a href="{{route('admin.application.verifiedonly')}}" class="btn btn-block btn-default">Verified Applications</a></div>

			<div class="button margin10"><a href="{{route('admin.application.rejectedonly')}}" class="btn btn-block btn-default">Rejected Applications</a></div>

			<div class="button margin10"><a href="{{route('admin.application.verify',['id'=>4])}}" class="btn btn-block btn-default">Verify</a></div>
		</div>
		<div class="col-lg-9">
		</div>
	</div>
</div>
@endsection