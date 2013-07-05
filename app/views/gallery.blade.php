@extends('master')

@section('pageTitle')
    {{ $categoryName.' | '.$siteData['settings']['site_name'] }}
@stop

@section('content')
    @include('gallery.vertical')
@stop
