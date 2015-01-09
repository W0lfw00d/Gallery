<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
        @section('pageTitle')
            {{ $siteData['settings']['site_name'] }}
        @show
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        {{--Why use PHP to make a absolute path? Don't see the point yet. Useful for Content servers? --}}
        {{ HTML::style('assets/style.min.css') }}
        <!--[if lt IE 10]> {{ HTML::style('css/ie.css') }} <![endif]-->
        {{ HTML::script('assets/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}
        @yield('inline-style')
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        @section('nav_menu')
            <nav class="navbar navbar-inverse navbar-fixed-top {{ $siteData['settings']['logo-align-class'] }}">
                <div class="navbar-inner">

    				<a href="#" class="logo logo_menu" data-toggle="collapse" data-target=".nav-collapse">
                            {{ HTML::image($siteData['settings']['logoUploadDir'].'/'.$siteData['settings']['logo']) }}
    				</a>

    				<div class="nav-collapse collapse">
                        <ul class="nav {{ ($siteData['settings']['logo-align-class'] == 'logo-right' ? 'pull-left' : 'pull-right') }}">
    						<li class="dropdown">
    							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Works<b class="caret"></b></a>
    							<ul class="dropdown-menu">
                                @section('category-menu')
    								@foreach($siteData['categories'] as $category)
                                          <li>{{ HTML::link('work/'.$category->slug,$category->name)}}</li>
                                    @endforeach
                                @show
    							</ul>
    						</li>
                        @section('main-menu')
                            <li>{{ HTML::link('about','About')}}</li>
                            <li>{{ HTML::link('contact','Contact')}}</li>
                        @show

    					</ul>
    				</div><!--/.nav-collapse -->

                    <a href="/">
                    <!-- this link needs to be come customizable -->
                        <div class="logo">
                            {{ HTML::image($siteData['settings']['logoUploadDir'].'/'.$siteData['settings']['logo']) }}
                        </div>
                    </a>
                </div>
            </nav>
        @show
        <div class="container-fluid">
            @yield('content')
        </div>

        <script>window.jquery || document.write('<script src="/assets/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        {{ HTML::script('assets/script.min.js') }}
        {{ HTML::script('assets/vendor/idangerous.swiper.scrollbar-2.1.js') }}

        <!-- Google Analytics -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-XXXX-Y', 'auto');
        ga('send', 'pageview');
        </script>
        <!-- End Google Analytics -->
    </body>
</html>