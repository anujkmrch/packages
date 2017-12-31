@extends('SystemView::auth.auth')
@section('content')
    <div class="auth login">
    <div class="wrapper">
        <div class="form-box">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form role="form" method="POST" action="{{ route('auth.password.reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">{{trans('SystemLang::auth.reset_password.label.email')}}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="{{trans('SystemLang::auth.reset_password.input.email')}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">{{trans('SystemLang::auth.reset_password.label.password')}}</label>
                            <input id="password" type="password" class="form-control" name="password" required placeholder="{{trans('SystemLang::auth.reset_password.input.password')}}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                             @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label">{{trans('SystemLang::auth.reset_password.label.password_confirmation')}}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{trans('SystemLang::auth.reset_password.input.password_confirmation')}}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">
                                    {{trans('SystemLang::auth.reset_password.button_text')}}
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@stop
