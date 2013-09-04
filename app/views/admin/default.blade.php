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
            Admin
        @show
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        {{ HTML::style('assets/admin/bootstrap.css') }}
        {{ HTML::style('assets/admin/bootstrap-responsive.css') }}
        {{ HTML::style('assets/admin/dropzonejs.css') }}
        {{ HTML::style('assets/admin/admin.css') }}
        <!--[if lt IE 10]> {{ HTML::style('css/ie.css') }} <![endif]-->
        {{ HTML::script('assets/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}
        @yield('inline-style')
    </head>
    <body class="admin-content">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span2">
                    <!--Sidebar content-->
                    @section('nav_menu')
                        <nav class="navbar">
                            <ul class="unstyled">
                                @section('category-menu')
                                    <li>{{ HTML::link('admin/index','Home page')}}</li>
                                    <li>{{ HTML::link('admin/theme','Theme')}}</li>
                                    <li>{{ HTML::link('admin/category','Categories')}}</li>
                                    <li class="option">{{ HTML::link('admin/gallery/create','+ Add project')}}</li>
                                    <ul>
                                        @foreach($siteData['categories'] as $category)
                                            <li>{{ HTML::link('admin/category/'.$category->id.'/edit',$category->name)}}</li>
                                            <ul>
                                                @foreach($category->galleries()->get() as $gallery)
                                                    <li>{{ HTML::link('admin/gallery/'.$gallery->id.'/edit',$gallery->name)}}</li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                                    <li class="option">{{ HTML::link('admin/category/create','+ Add category')}}</li>
                                @show
                            @section('main-menu')
                                <li>{{ HTML::link('admin/page/1/edit','About page')}}</li>
                                <li>{{ HTML::link('admin/page/2/edit','Contact page')}}</li>
                                <li>{{ HTML::link('admin/images','Remove images')}}</li>
                                <li>{{ HTML::link('admin/settings','Settings')}}</li>
                                <li>{{ HTML::link('logout','Logout')}}</li>
                            @show
                            </ul>
                        </nav>
                    @show
                </div>
                <div class="span8 gallery">
                <!-- Notifications -->
                @include('notifications')
                <!-- ./ notifications -->

                @yield('content')
                </div>
            </div>
        </div>

        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
        <script>window.jquery || document.write('<script src="/assets/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        {{ HTML::script('assets/script.min.js') }}
        {{ HTML::script('assets/vendor/ckeditor/ckeditor.js') }}
    </body>
</html>