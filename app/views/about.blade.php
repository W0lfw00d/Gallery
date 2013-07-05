@extends('master')

@section('pageTitle')
    About | {{ $siteData['settings']['site_name'] }}
@stop

@section('content')
	
	@section('page_name')
		{{ $page->name }}
	@stop

	@section('page_content')
		{{ $page->content }}
	@stop

	@include('pages.text')
@endsection
