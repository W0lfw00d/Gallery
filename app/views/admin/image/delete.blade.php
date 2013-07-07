@extends('admin/default')

@section('pageTitle')
	Delete images | {{ $siteData['settings']['site_name'] }}
	@parent
@stop

@section('content')

{{ Form::open(array('url' => 'admin/images',
						'method' => 'delete',
						'class' => 'form-horizontal',
						'autocomplete'=>'off',
						'id' => 'deleteImagesForm')) }}
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

	<h2>Gallery library</h2>
	<!--div class="controls galley_images"-->
	<ul class="thumbnails connected" id="deleteGalleryLibrary">
		@if(is_array($galleryLibrary))
			@foreach($galleryLibrary as $libImage)
				<?php $baseName = pathinfo($libImage,PATHINFO_BASENAME); ?>
				<li id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['galleryUploadDir'] .'/thumb/'.$baseName,$baseName) }}
					</a>
				</li>
			@endforeach
		@endif
	</ul>

	<h2>Foreground library</h2>
	<ul class="thumbnails connected" id="deleteForegroundLibrary">
		@if(is_array($foregroundLibrary))
			@foreach($foregroundLibrary as $libImage)
				<li id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['foregroundUploadDir'] .'/thumb/'.pathinfo($libImage,PATHINFO_BASENAME)) }}
					</a>
				</li>
			@endforeach
		@endif
	</ul>

	<h2>Background library</h2>
	<ul class="thumbnails connected" id="deleteBackgroundLibrary">
		@if(is_array($backgroundLibrary))
			@foreach($backgroundLibrary as $libImage)
				<li id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['backgroundUploadDir'] .'/thumb/'.pathinfo($libImage,PATHINFO_BASENAME)) }}
					</a>
				</li>
			@endforeach
		@endif
	</ul>

	<h2>Logo library</h2>
	<ul class="thumbnails connected" id="deleteLogoLibrary">
		@if(is_array($logoLibrary))
			@foreach($logoLibrary as $libImage)
				<li id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['logoUploadDir'] .'/thumb/'.pathinfo($libImage,PATHINFO_BASENAME)) }}
					</a>
				</li>
			@endforeach
		@endif
	</ul>

{{ Form::close() }}
@stop