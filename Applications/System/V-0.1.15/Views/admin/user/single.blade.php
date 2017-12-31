@extends('SystemView::admin.admin')
@section('content')
<div class="admin user">
    <div class="wrapper">
    	<div class="small">
            <form action="{{route('admin.user.search')}}" method="GET" class="form" role="form">
                <div class="fc-grp">
                    <label class="sr-only" for="">Search user</label>
                    <input type="text" name="q" class="fc-in" id="" placeholder="Search user">
                    <span class="text-muted">Search user by email or username</span>
                </div>
                <button type="submit" class="btn btn-block btn-{{!$user ? 'danger' : 'info'}}">Search</button>
            </form>

            <form action="{{route('admin.user.delete')}}" method="POST" role="form" class="form">
                {{csrf_field()}}
                <input type="hidden" name="user" value="{{$user->id}}">
                <input type="submit" value="Delete user" class="btn btn-block btn-default margin10">
            </form>
            
            <div class="button margin10"><a href="{{route('admin.user.create')}}" class="btn btn-block btn-default">Create new user</a></div>

            <div class="button margin10"><a href="{{route('admin.user.index')}}" class="btn btn-block btn-default">Go back</a></div>

            <div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-default">Frontpage</a></div>

        </div>
    @if($user)
    	<div class="big profile">
             <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <p class="alert alert-{{ $msg }}"><i class="fa fa-coffee"></i> {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
            </div>
            <h1>{{trans('SystemLang::user.form.title')}}</h1>
            <hr>
            <form class="form" role="form" method="post" action="{{route('admin.user.update',['id'=>$user->id])}}">
            {{csrf_field()}}
                <div class="fc-grp{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label>{{trans('SystemLang::user.form.firstname')}}</label>
                    <div class="col-lg-8">
                      <input class="fc-in" name="first_name" type="text" value="{{$user->first_name}}" placeholder="{{trans('SystemLang::user.form.placeholder.firstname')}}">
                        @if ($errors->has('first_name'))
                          <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                        @endif
                    </div>
                </div>
                <div class="fc-grp{{ $errors->has('first_name') ? ' has-error' : '' }}">
                  <label >{{trans('SystemLang::user.form.lastname')}}</label>
                  <input class="fc-in" name="last_name" type="text" value="{{$user->last_name}}" placeholder="{{trans('SystemLang::user.form.placeholder.lastname')}}">
                  @if ($errors->has('last_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="fc-grp{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label>{{trans('SystemLang::user.form.company')}}</label>
                <input class="fc-in" name="company" type="text" value="{{$user->company}}">
                @if ($errors->has('company'))
                  <span class="help-block">
                    <strong>{{ $errors->first('company') }}</strong>
                  </span>
                @endif
              </div>

              <div class="fc-grp{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>{{trans('SystemLang::user.form.email')}}</label>
                <input class="fc-in" name="email" type="text" value="{{$user->email}}">
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
              
              <div class="fc-grp{{ $errors->has('username') ? ' has-error' : '' }}">
                <label>{{trans('SystemLang::user.form.username')}}</label>
                <input class="fc-in" type="text" name="username" value="{{$user->username}}" readonly>
                 @if ($errors->has('username'))
                  <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                @endif
              </div>
              <div class="fc-grp{{ $errors->has('roles') ? ' has-error' : '' }}">
                <label>{{trans_choice('SystemLang::user.form.user_roles',config('system.multirole',0))}}</label>
                <select placeholder="Select User Role" id="chosen" class="fc-select chosen" name="roles{!!config('webodeci.multirole',false)? '[]" multiple="true"':'"'!!} >
                    @php ($keys = $user->roles->groupBy('slug')->keys()->toArray())
                    @foreach($roles as $role)
                    <option value="{{$role->id}}"{{in_array($role->slug,$keys) ? ' selected' : ''}}>{{$role->title}}</option>
                    @endforeach
                </select>
                @if ($errors->has('roles'))
                  <span class="help-block">
                    <strong>{{ $errors->first('roles') }}</strong>
                  </span>
                @endif
              </div>

              <div class="fc-grp{{ $errors->has('new_password') ? ' has-error' : '' }}">
                @if ($errors->has('new_password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('new_password') }}</strong>
                  </span>
                @endif
                <label>{{trans('SystemLang::user.form.new_password')}}</label>
                <input class="fc-in" type="password" name="new_password" value="" placeholder="Enter new password to update">
              </div>

              <div class="fc-grp">
                <label>{{trans('SystemLang::user.form.confirm_password')}}</label>
                <input class="fc-in" type="password" name="new_password_confirmation" value="" placeholder="Confirm new password">
              </div>

              <div class="fc-grp">
                <input type="submit" class="btn btn-primary" value="Save Changes">
                <span></span>
                <input type="reset" class="btn btn-default" value="Cancel">
              </div>
          </form>
    	</div>
    @else
    <div class="col-lg-9 profile text-center">
    	<h1 class="error text-danger"><i class="fa fa-ban"></i> Profile not found</h1>
    </div>
    @endif
    </div>
</div>
@endsection