@extends('SystemView::auth.auth')
@section('content')
<div class="auth login">
    <div class="wrapper">
            <form class="form" role="form" method="POST" action="{{ route('auth.password.email') }}">
                {{ csrf_field() }}
                <legend>{{@trans('SystemLang::authentication.forgot_password.title')}}</legend>
                <div class="fc-grp{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="fc-lbl"> {{trans('SystemLang::auth.forgot_password.key_label')}}</label>
                    <input id="email" type="email" class="fc-in" name="email" value="{{ old('email') }}" required placeholder=" {{trans('SystemLang::auth.forgot_password.key_input')}}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="fc-grp">
                    <button type="submit" class="fc-btn">
                        {{trans('SystemLang::auth.forgot_password.button_text')}}
                    </button>
                </div>
                <hr>
                <div class="fc-grp">
                    {!! trans('SystemLang::auth.forgot_password.login_link',['link'=>route('auth.login')])!!}
                </div>
            </form>
        </div>
    </div>
@stop
