@extends('master')

@section('pageTitle')
    {{ $page->name.' | '.$siteData['settings']['site_name'] }}
@stop

@section('inline-style')
	<style type="text/css">
	    html {
		    /* This image will be displayed fullscreen */
		    background:url('{{ Request::root().$siteData['settings']['backgroundUploadDir'].'/large/'.$siteData['settings']['indexBackground'] }}') no-repeat center center fixed; 
		    min-height:100%;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
		    background-size:cover; /*contain*/
		}

		body {
		    /* Workaround for some mobile browsers */
		    min-height:100%;
		    background-color: transparent;
		}

		@-moz-document url-prefix() {
		  	.ff.center-this {
				/* Firefox */
				position: relative;
			    display: -moz-box;
			    top:inherit;
			    bottom:inherit;
			    -moz-box-pack: center;
			    -moz-box-align: center;
			    
			}
		}
	</style>
@stop

@section('nav_menu')
@stop

@section('content')
	<div class="center-this ff">
		<div class="logo-index">
			<a href="work">
				{{ HTML::image($siteData['settings']['foregroundUploadDir'].'/'.$siteData['settings']['indexForeground']) }}
			</a>
		</div>
	</div>
@stop
