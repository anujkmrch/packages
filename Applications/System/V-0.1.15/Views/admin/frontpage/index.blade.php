@extends('SystemView::admin.admin')
@section('content')
<div class="admin frontpage">
    <div class="wrapper">
        @if(count($dashboards))
        <div class="dashboards">
            @foreach($dashboards as $dashboard)
                <div class="dashboard">
                    <div class="title">{{$dashboard['title']}}</div>
                    <div class="content">
                        @if(array_key_exists('callback', $dashboard) 
                            and is_callable($dashboard['callback']))
                            {!! call_user_func($dashboard['callback']) !!}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        @if(count($cells))
        <div class="qabs">
        @foreach($cells as $key => $cell)
            <div class="qab" id="key_{{$key}}">
                <div class="thumbnail text-center">
                    <div class="title">{{ $cell['title'] }}</div>
                    @if($cell['fa'])
                        <div class="icon"><i class="fa {{$cell['fa']}}"></i></div>
                    @endif
                    <a href="{{route($cell['route'])}}" class="route btn">View</a>
                </div>
            </div>
        @endforeach
        </div>
        @endif
    </div>
</div>
@endsection