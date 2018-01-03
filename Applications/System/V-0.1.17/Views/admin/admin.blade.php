<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Welcome</title>
        <link rel="stylesheet" href="/bs/css/bootstrap.min.css">
        {{-- <link rel="stylesheet" href="/system/admin.min.css"> --}}
        <link href="/fa/css/font-awesome.min.css" rel="stylesheet">
        <script src="/js/jquery-3.2.1.min.js"></script>
        <style type='text/css'>
        .navbar {
            border-radius: 0;
        }
        .admin {
          vertical-align: top !important;
          padding: 3em 0; }

        .main,
        .dashbar {
            margin-bottom: 0;
        }

        .dashcard {
            border: 1px solid #eee;
            background-color: #fff;
            border-radius: 0;
            padding: 1em;
            display: block;
            margin-bottom: 1em;
        }

        .dashcard .title {
            font-size: 1.8em;
            font-weight: 100;
        }

        .dashcard .content {}

        .footer {
            border-top: 1px solid #ddd;
            padding: 1em;
            margin-top: 2em;
        }
        .toolbar{
            background-color: #eee;
            margin-top:1em;
            padding:.5em;
            border-radius:.2em;
        }
        .toolbar a{
            border-radius:0;
            padding:.1em .5em;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            color: white;
            font-size: 15px;
            background-color: #000;
            margin-left:.2em;
            text-decoration:none;  
        }
        .toolbar a:hover {
            background-color: #4CAF50;
        }
        h1{
            color:#f47721;
            font-size:1.2em;
        }
        a{
            color:#f47721 !important;
        }
    </style>
    </head>
    <body>
        <nav class="navbar navbar-default main" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Title</a>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <div class="navbar-right">
                        {!! \Admin::getHydratedMenu('usermenu',true) !!}
                    </div>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

        @if(\Admin::has_menus('sidebar'))
            <nav class="navbar navbar-inverse dashbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-dashbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-dashbar-collapse">
                    {!! \Admin::getHydratedMenu('sidebar',true) !!}
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        @endif
        @if(\Admin::has_toolbar())
            <div class="container">
                <div class="col-lg-12 text-right">
                    <div class="toolbar">
                        {!! \Admin::getToolbar(true); !!}
                    </div>
                </div>
            </div>
        @endif
        @yield("content")
        <script src="/js/jquery.min.js" type="text/javascript"></script>
        <script src="/bs/js/bootstrap.min.js"></script>
    </body>
</html>
