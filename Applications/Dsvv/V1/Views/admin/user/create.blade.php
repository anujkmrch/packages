@extends('SystemView::admin.admin')
@section('content')
<div class="container paged">
	<div class="row">
		<div class="col-lg-3">
            <form action="{{route('admin.user.search')}}" method="GET" class="form" role="form">
                <div class="form-group">
                    <label class="sr-only" for="">Search user</label>
                    <input type="text" name="q" class="form-control" id="" placeholder="Search user">
                    <span class="text-muted">Search user by email or username</span>
                </div>
                <button type="submit" class="btn btn-block btn-info">Search</button>
            </form>
            
            <!-- <div class="button margin10"><a href="{{route('admin.user.create')}}" class="btn btn-block btn-default">Create new user</a></div> -->

            <div class="button margin10"><a href="{{route('admin.user.index')}}" class="btn btn-block btn-default">Go back</a></div>

            <div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-default">Frontpage</a></div>

        </div>
	<form class="form-horizontal" role="form" method="post" action="{{route('admin.user.create')}}">
		{{csrf_field()}}
      	<!-- edit form column -->
      	<div class="col-md-9 personal-info">
        <h1>{{trans('DevLang::user.create.title')}}</h1>
        <hr>
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))
              <p class="alert alert-{{ $msg }}"><i class="fa fa-coffee"></i> {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
        </div>
        <h3>{{trans('DevLang::user.form.title')}}</h3>
        <div class="form-group">
            <label class="col-lg-3 control-label">{{trans('DevLang::user.form.firstname')}}</label>
            <div class="col-lg-8">
              <input class="form-control" name="first_name" type="text" value="{{ old('first_name') }}" placeholder="{{trans('DevLang::user.form.placeholder.firstname')}}">
            </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">{{trans('DevLang::user.form.lastname')}}</label>
            <div class="col-lg-8">
              <input class="form-control" name="last_name" type="text" value="{{ old('last_name') }}" placeholder="{{trans('DevLang::user.form.placeholder.lastname')}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">{{trans('DevLang::user.form.company')}}</label>
            <div class="col-lg-8">
              <input class="form-control" name="company" type="text" value="{{ old('company') }}" placeholder="{{trans('DevLang::user.form.placeholder.company')}}"">
            </div>
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	      	 @if ($errors->has('email'))
	          <span class="help-block">
	            <strong>{{ $errors->first('email') }}</strong>
	          </span>
	        @endif
            <label class="col-lg-3 control-label">{{trans('DevLang::user.form.email')}}</label>
            <div class="col-lg-8">
              <input class="form-control" name="email" type="text" value="{{ old('email') }}"  placeholder="{{trans('DevLang::user.form.placeholder.email')}}" required>
            </div>
          </div>
          
          <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
	      	 @if ($errors->has('username'))
	          <span class="help-block">
	            <strong>{{ $errors->first('username') }}</strong>
	          </span>
	        @endif">
            <label class="col-md-3 control-label">{{trans('DevLang::user.form.username')}}</label>
            <div class="col-md-8">
              <input class="form-control" type="text" name="username" value="{{ old('username') }}"  placeholder="{{trans('DevLang::user.form.placeholder.username')}}"  required>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-md-3 control-label">{{trans('DevLang::user.form.user_roles')}}</label>
          	<div class="col-md-8">
          		<select placeholder="{{trans('DevLang::user.form.placeholder.user_roles')}}" id="chosen" class="form-control chosen" name="roles{!!config('webodeci.multirole',false)? '[]" multiple="true"':'"'!!}>
          			@foreach($roles as $role)
          			<option value="{{$role->id}}">{{$role->title}}</option>
          			@endforeach
          		</select>
          	</div>
          </div>
          
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
            <label class="col-md-3 control-label">{{trans('DevLang::user.form.password')}}</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="password" value="" placeholder="{{trans('DevLang::user.form.placeholder.password')}}" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">{{trans('DevLang::user.form.confirm_password')}}</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="password_confirmation" value="" placeholder="{{trans('DevLang::user.form.placeholder.confirm_password')}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="{{trans('DevLang::user.form.save')}}">
              <span></span>
              <input type="reset" class="btn btn-default" value="{{trans('DevLang::user.form.cancel')}}">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection