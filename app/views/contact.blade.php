@extends('master')

@section('pageTitle')
    Contact | {{ $siteData['settings']['site_name'] }}
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