@extends('SystemView::admin.admin')
@section('content')
<div class="admin user">
	<div class="wrapper container">
		<div class="small col-lg-4">
            <form action="{{route('admin.user.search')}}" method="GET" class="form" role="form">
                <div class="fc-grp form-group">
                    <label class="sr-only" for="">Search user</label>
                    <input type="text" name="q" class="form-control fc-in" id="" placeholder="Search user">
                    <span class="text-muted">Search user by email or username</span>
                </div>
                <button type="submit" class="btn btn-block btn-info">Search</button>
            </form>
            
        </div>
        <div class="big col-lg-8">
	<form class="form" role="form" method="post" action="{{route('admin.user.create')}}">
		{{csrf_field()}}
      	<div class="col-md-9 personal-info">
        <h1>{{trans('SystemLang::user.create.title')}}</h1>
        <hr>
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))
              <p class="alert alert-{{ $msg }}"><i class="fa fa-coffee"></i> {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
        </div>
        <h3>{{trans('SystemLang::user.form.title')}}</h3>
        <div class="fc-grp form-group">
            <label class="fc-lbl">{{trans('SystemLang::user.form.firstname')}}</label>
            <input class="fc-in form-control" name="first_name" type="text" value="{{ old('first_name') }}" placeholder="{{trans('SystemLang::user.form.placeholder.firstname')}}">
        </div>
        <div class="form-group">
          <label class="fc-lbl">{{trans('SystemLang::user.form.lastname')}}</label>
            <input class="form-control fc-in" name="last_name" type="text" value="{{ old('last_name') }}" placeholder="{{trans('SystemLang::user.form.placeholder.lastname')}}">
          </div>
          <div class="fc-grp form-group">
            <label class="fc-lbl">{{trans('SystemLang::user.form.company')}}</label>
              <input class="fc-in form-control" name="company" type="text" value="{{ old('company') }}" placeholder="{{trans('SystemLang::user.form.placeholder.company')}}"">
          </div>
          <div class="form-group fc-grp{{ $errors->has('email') ? ' has-error' : '' }}">
	      	 @if ($errors->has('email'))
	          <span class="help-block">
	            <strong>{{ $errors->first('email') }}</strong>
	          </span>
	        @endif
            <label class="col-lg-3 fc-lbl">{{trans('SystemLang::user.form.email')}}</label>
              <input class="fc-in form-control" name="email" type="text" value="{{ old('email') }}"  placeholder="{{trans('SystemLang::user.form.placeholder.email')}}" required>
          </div>
          
          <div class="form group fc-grp{{ $errors->has('username') ? ' has-error' : '' }}">
	      	 @if ($errors->has('username'))
	          <span class="help-block">
	            <strong>{{ $errors->first('username') }}</strong>
	          </span>
	        @endif
            <label class="fc-lbl">{{trans('SystemLang::user.form.username')}}</label>
            <input class="fc-in form-control" type="text" name="username" value="{{ old('username') }}"  placeholder="{{trans('SystemLang::user.form.placeholder.username')}}"  required>
          </div>
          
          <div class="fc-grp form-group">
          	<label class="fc-lbl">{{trans_choice('SystemLang::user.form.user_roles',config('system.multirole',0))}}</label>
         		<select placeholder="{{trans('SystemLang::user.form.placeholder.user_roles')}}" id="chosen" class="fc-select chosen form-control" name="roles{!!config('system.multirole',false)? '[]" multiple="true"':'"'!!}>
          			@foreach($roles as $role)
          			<option {!!(config('system.default_user_role','subscriber') === $role->slug ? " selected=\"true\"":'') !!} value="{{$role->id}}">{{$role->title}}</option>
          			@endforeach
          		</select>
          </div>
          
          <div class="form-group fc-grp{{ $errors->has('password') ? ' has-error' : '' }}">
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
            <label class="fc-lbl">{{trans('SystemLang::user.form.password')}}</label>
            <input class="form-control fc-in" type="password" name="password" value="" placeholder="{{trans('SystemLang::user.form.placeholder.password')}}" >
          </div>

          <div class="form-group fc-grp">
            <label class="fc-lbl">{{trans('SystemLang::user.form.confirm_password')}}</label>
            <input class="fc-in form-control" type="password" name="password_confirmation" value="" placeholder="{{trans('SystemLang::user.form.placeholder.confirm_password')}}">
          </div>
          <div class="fc-grp">
            <input type="submit" class="btn btn-primary" value="{{trans('SystemLang::user.form.save')}}">
              <span></span>
            <input type="reset" class="btn btn-default" value="{{trans('SystemLang::user.form.cancel')}}">
          </div>
        </form>
        </div>
      </div>
  </div>
</div>
@endsection