<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! SEO::generate(true) !!}
        <link rel="stylesheet" href="/bs/css/bootstrap.min.css">
        <link href="/fa/css/font-awesome.min.css" rel="stylesheet">
        <script src="/js/jquery-3.2.1.min.js"></script>
        <style type="text/css">
            .navbar
            {
                margin-bottom: 0;
            }
            #banner
            {
                background-color:#000;
                text-align: center;
                color: #fff;
                padding:7em 0;
                
            }
            #banner.jumbotron .title{
                font-size:3em;
                font-weight:100 !important;
                margin:0;
                padding:0;
            }

            #banner.jumbotron .head {
                font-size:2em;
                font-weight:100 !important;
                margin:0;
                padding:0;
            }

            #banner.jumbotron .lead {
                font-size:1.4em;
                font-weight:100 !important;
                margin:0;
                padding:0;
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
                @if(position_has_widget('user'))
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <div class="navbar-right">
                        {!! widget_render("user") !!}
                    </div>
                </div><!-- /.navbar-collapse -->
                @endif
            </div>
        </nav>
           
        @if(position_has_widget('banner'))
         <div class="jumbotron" id="banner">
            <div class="container">
                {!! widget_render("banner") !!}
            </div>
          </div><!-- /.navbar-collapse -->
        @endif
        
        @if(position_has_widget('containment'))
         <div class="onetwothree" id="containment">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                {!! widget_render("containment") !!}
                </div>
                </div>
            </div>
          </div><!-- /.navbar-collapse -->
          @endif
        @yield("content")
        <script src="/js/jquery.min.js" type="text/javascript"></script>
        <script src="/bs/js/bootstrap.min.js"></script>
    </body>
</html>
