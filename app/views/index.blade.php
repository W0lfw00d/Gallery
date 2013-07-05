@extends('master')

@section('pageTitle')
    {{ $page->name.' | '.$siteData['settings']['site_name'] }}
@stop

@section('inline-style')
	<style type="text/css">
	    html {
		    /* This image will be displayed fullscreen */
		    background:url('{{ Request::root().$siteData['settings']['backgroundUploadDir'].'/large/'.$siteData['settings']['indexBackground'] }}') no-repeat center center;
		    min-height:100%;
		    background-size:cover; /*contain*/
		}

		body {
		    /* Workaround for some mobile browsers */
		    min-height:100%;
		    background-color: transparent;
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
