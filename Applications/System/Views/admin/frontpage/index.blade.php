@extends('SystemView::admin.admin')
@section('content')
<div class="admin frontpage">
    <div class="wrapper">
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
</div>
@endsection