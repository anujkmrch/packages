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
                        @if(position_has_widget('user'))
                            {!! widget_render("user") !!}
                        @endif
                    </div>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        @yield("content")
        <script src="/js/jquery.min.js" type="text/javascript"></script>
        <script src="/bs/js/bootstrap.min.js"></script>
    </body>
</html>
