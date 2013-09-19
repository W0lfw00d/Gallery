@extends('master')

@section('pageTitle')
    Contact | {{ $siteData['settings']['site_name'] }}
@stop

@section('inline-style')
  <style type="text/css">
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

@section('content')
	<div class="gallery">
		{{-- @include('contactForm') --}}
		<div class="ff center-this">
			<div class="text-center"> 
				{{ $page->content }}
			</div>
		</div>
 	</div>
@stop