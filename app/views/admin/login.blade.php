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

			<div class="center-this ff">
				<div class="logo-index">
					
        			{{ HTML::image($siteData['settings']['logoUploadDir'].'/small/'.$siteData['settings']['logo']) }}
					
					{{ Form::open(array('url' => 'admin',
											'class' => 'form-horizontal',
											'autocomplete'=>"off")) }}

						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

						<div class="control-group {{{ $errors->has('name') ? 'error' : '' }}}">
							<div class="controls">
								<input type="text" name="username" id="username" value="{{{ Input::old('username') }}}" placeholder="username" />
								{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
							   <input type="password" name="password" id="caption" value="" placeholder="password" />
								{{ $errors->first('caption', '<span class="help-inline">:message</span>') }}
							</div>
						</div>

						<div class="control-group invisible">
							<div class="controls">
								{{ Form::submit('Enter',array('class'=>'btn btn-success')) }}
							</div>
						</div>

					{{ Form::close() }}
				</div>
			</div>

        </div>

        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
        <script>window.jquery || document.write('<script src="/assets/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        {{ HTML::script('assets/script.min.js') }}
        {{ HTML::script('assets/vendor/ckeditor/ckeditor.js') }}
    </body>
</html>