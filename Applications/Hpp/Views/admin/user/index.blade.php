@extends('SystemView::admin.admin')
@section('content')
<div class="admin user">
    <div class="wrapper">
    @if(count($users))
    <div class="small">
        <form action="{{route('admin.user.search')}}" method="GET" class="form" role="form">
            <div class="fc-grp">
                <label class="sr-only" for="">Search user</label>
                <input type="text" name="q" class="fc-in" id="" placeholder="Search user">
                <span class="text-muted">Search user by entering email or username</span>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Search</button>
        </form>
        <div class="button margin10"><a href="{{route('admin.user.create')}}" class="btn btn-block btn-default">Create new user</a></div>

        <div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-default">Frontpage</a></div>
    </div>
    <div class="big">
        <table class="table table-striped table-bordered table-hover ">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Roles</th>
                <th>Enabled</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->name}}</td>
                <td>
                    <a href="{{route('admin.user.single',['id'=>$user->username])}}" class="action">
                        <i class="fa fa-gear"></i> Manage
                    </a>
                </td> 
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>
</div>
@endsection