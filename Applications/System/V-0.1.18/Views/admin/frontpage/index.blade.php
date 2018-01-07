@extends('SystemView::admin.admin')
@section('content')
<div class="admin frontpage">
    <div class="container wrapper">
        @if(count($dashboards))
        <div class="dashboards col-lg-8">
            @foreach($dashboards as $dashboard)
                <div class="col-lg-12">
                    @if(array_key_exists('callback', $dashboard) 
                        and is_callable($dashboard['callback']))
                        {!! call_user_func_array($dashboard['callback'],[$dashboard]) !!}
                    @endif
                </div>
            @endforeach
        </div>
        @endif
        @if(count($cells))
        <div class="qabs clearfix col-lg-4">
            <div class="list-group">
                
        @foreach($cells as $key => $cell)
            <a href="{{route($cell['route'])}}" class="list-group-item">@if($cell['fa'])<i class="fa {{$cell['fa']}}"></i>@endif {{$cell['title']}}</a>
        @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection