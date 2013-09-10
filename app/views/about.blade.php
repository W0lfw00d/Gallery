@extends('master')

@section('pageTitle')
    About | {{ $siteData['settings']['site_name'] }}
@stop

@section('content')
	<div class="gallery"> 
  		<div class="gallery_wrapper"> 
	  		<div class="text content-page">
                 <div class="swiper-container swiper-text-scroll">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        {{ $page->content }} 
                      </div>
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>
			</div>
    	</div>
	</div>
	
@endsection
