@extends('SystemView::client.client')
@section('content')
<div class="auth login">
	<div class="wrapper">
		<form action="{{route_with_redirect('auth.login')}}" id="login" method="post" class="form">
			{{csrf_field()}}
			<legend>{{@trans('SystemLang::authentication.login.title')}}</legend>
			<div class="fc-grp{{ $errors->has('email')|| $errors->first('username') ? ' has-error' : '' }}">
				<label class="fc-lb">{{@trans('SystemLang::authentication.login.label.key')}}</label>
				<input type="text" name="email" value="{{ old('email') }}" class="fc-in" placeholder="{{@trans('SystemLang::authentication.login.input.key')}}">
				@if ($errors->has('email') or $errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}{{$errors->first('username')}}</strong>
                    </span>
                @endif
			</div>
			<div class="fc-grp{{ $errors->has('password') ? ' has-error' : '' }}">
				<label class="fc-lb">{{@trans('SystemLang::authentication.login.label.password')}}</label>
				<input type="password" class="fc-in" name="password" placeholder="{{@trans('SystemLang::authentication.login.input.password')}}">
				 @if ($errors->has('password'))
	                <span class="help-block">
	                    <strong>
	                        {{ $errors->first('password') }}
	                    </strong>
	                </span>
	            @endif
			</div>

			<div class="fc-grp cf footer">
				<a href="{{route('auth.password.reset')}}" class="fc-link pl">Forgot password?</a>
				<label for="" class="fc-lb pr">
					<div class="fc-ck"><input type="checkbox" name="remember_me"><span>Keep me logged in!</span></div>
				</label>

			</div>
			<a href="{{route('auth.register')}}" class="fc-btn col-red">Create new account</a>
			<input type="submit" class="fc-btn col-def" value="Login">
		</form>	
	</div>
</div>
@endsection