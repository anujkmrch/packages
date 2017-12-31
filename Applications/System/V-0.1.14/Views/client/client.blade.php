<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">{!! SEO::generate(true) !!}
        <link rel="stylesheet" href="/system/client.min.css">
        <link href="/fa/css/font-awesome.min.css" rel="stylesheet">
        <script src="/js/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <div id="top" class="header cf">
        	<div class="wrapper">
        		<h1 class="logo"><a href="/">MyCompanyName</a></h1>
        		@if(position_has_widget('user'))
                    {!! widget_render("user") !!}
			    @endif
        	</div>
        </div>
        @yield("content")
    </body>
</html>
