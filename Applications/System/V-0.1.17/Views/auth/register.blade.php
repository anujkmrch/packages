@extends('SystemView::auth.auth')
@section('content')
<div class="auth register">
	<div class="wrapper">
		<form action="{{route('auth.register')}}" id="register" method="post" class="form">
			<legend>{{@trans('SystemLang::authentication.register.title')}}</legend>
			{{csrf_field()}}
			<div class="fc-grp{{ $errors->has('name') ? ' has-error' : '' }}">
				<label class="fc-lb" for="">{{@trans('SystemLang::authentication.register.label.name')}}</label>
				<input type="text" class="fc-in" name="name" value="{{old('username')}}" placeholder="{{@trans('SystemLang::authentication.register.input.name')}}">
				 @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>
			<div class="fc-grp{{ $errors->has('username') ? ' has-error' : '' }}">
				<label class="fc-lb" for="">{{@trans('SystemLang::authentication.register.label.username')}}</label>
				<input type="text" class="fc-in" name="username" value="{{old('username')}}" placeholder="{{@trans('SystemLang::authentication.register.input.username')}}">
				 @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
			</div>

			<div class="fc-grp{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="">{{@trans('SystemLang::authentication.register.label.email')}}</label>
				<input type="text" class="fc-in"  value="{{old('email')}}" name="email" placeholder="{{@trans('SystemLang::authentication.register.label.email')}}">
				@if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>
			
			<div class="fc-grp{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="">{{@trans('SystemLang::authentication.register.label.password')}}</label>
				<input value="{{old('password')}}" type="password" class="fc-in" name="password" placeholder="{{@trans('SystemLang::authentication.register.label.password')}}">
				@if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
			</div>
			
			<div class="fc-grp{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
				<label for="">{{@trans('SystemLang::authentication.register.label.password_confirmation')}}</label>
				<input type="password" class="fc-in"  value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="{{@trans('SystemLang::authentication.register.input.password_confirmation')}}">
				@if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
			</div>
			
			<div class="fc-grp{{ $errors->has('terms_and_condition') ? ' has-error' : '' }}">
				<label for="" class="fc-lb f">
					<div class="fc-ck"><input type="checkbox" name="terms_and_conditions"><span>{!!@trans('SystemLang::authentication.register.terms_and_conditions',['link'=>config('system.terms_and_condition_url','#')])!!}</span></div>
				</label>
				@if ($errors->has('terms_and_conditions'))
                    <span class="help-block">
                        <strong>{{ $errors->first('terms_and_conditions') }}</strong>
                    </span>
                @endif
			</div>
			<div class="fc-grp">
				<input type="submit" class="fc-btn col-def" value="{{@trans('SystemLang::authentication.register.button_text')}}">
			</div>
		</form>
	</div>
</div>
@endsection