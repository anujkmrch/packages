<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Welcome</title>
        <link rel="stylesheet" href="/system/admin.min.css">
        <link href="/fa/css/font-awesome.min.css" rel="stylesheet">
        <script src="/js/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <div class="header">
            <div class="wrapper">
                <div class="logo"><a href="/admin">Admin</a></div>
                {{-- <ul class="nav">
                    <li><a href="#">Item 1</a></li>
                    <li><a href="#">Item 2</a></li>
                    <li><a href="#">Item 3</a></li>
                    <li><a href="#">Item 4</a></li>
                </ul> --}}
                @if(\Admin::has_menus('sidebar'))
                    {!! \Admin::getHydratedMenu('sidebar',true) !!}
                @endif
            </div>
        </div>
        
        @yield("content")
    </body>
</html>
