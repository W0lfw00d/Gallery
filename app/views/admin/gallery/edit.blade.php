@extends('admin/default')

@section('pageTitle')
	Edit the project: '{{$gallery->name}}'| {{ $siteData['settings']['site_name'] }}
@parent
@stop

@section('content')
<div class="page-header">
	<h3>
		Edit the project: '{{$gallery->name}}'

		<div class="pull-right">
			<a href="{{{ URL::to('admin/category/'.$gallery->category_id.'/edit') }}}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>

@include('admin.imgSlideTemplate')
@include('admin.dropzone')

{{ Form::open(array('url' => 'admin/gallery/'.$gallery->id,
						'method' => 'put',
						'class' => 'form-horizontal',
						'autocomplete'=>"off")) }}
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

	<h2>Visible Gallery</h2>
	<ul class="thumbnails connected" id="slideGallery">
		@foreach($slides as $slide)
			@if($slide->contentType_id==1)
				<li class="swap" id="slideImg_{{{ $slide->content }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['galleryUploadDir'].'/thumb/'.$slide->content,$slide->content) }}
					</a>
					{{ Form::hidden('slideContent[]', $slide->content) }}
					{{ Form::hidden('slideId[]', $slide->id) }}
					{{ Form::hidden('slideType[]', '1') }}
				</li>
			@endif
		@endforeach
	</ul>

	<h2>Image library</h2>
	<ul class="thumbnails connected" id="imgLibrary">
		<li>
		    <a href="#" class="thumbnail center-this" data-toggle="collapse" data-target="#uploadForm">
				{{ HTML::image('img/file_plus.png') }}
			</a>
		</li>
		@if(is_array($imageLibrary))
			@foreach($imageLibrary as $libImage)
				<?php $baseName = pathinfo($libImage,PATHINFO_BASENAME); ?>
				<li class="swap" id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['galleryUploadDir'] .'/thumb/'.$baseName,$baseName) }}
					</a>
					{{ Form::hidden('slideContent[]',$baseName,array('disabled'=>'disabled')) }}
					{{ Form::hidden('slideType[]',1,array('disabled'=>'disabled')) }}
				</li>
			@endforeach
		@endif
	</ul>

	<div class="input-pane">

		<div class="control-group {{{ $errors->has('name') ? 'error' : '' }}}">
			<label class="control-label" for="name">Gallery name</label>
			<div class="controls">
				<input type="text" name="name" id="name" value="{{{ Input::old('title', $gallery->name) }}}" />
				{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
			</div>
		</div>

		<div class="control-group">
			{{ Form::label('caption', 'Caption', array('class' => 'control-label')); }}
			<div class="controls">
			   <input type="text" name="caption" id="caption" value="{{{ Input::old('caption', $gallery->caption) }}}" />
				{{ $errors->first('caption', '<span class="help-inline">:message</span>') }}
			</div>
		</div>

		<div class="control-group">
			{{ Form::label('info', 'Info', array('class' => 'control-label')); }}
			<div class="controls">
			    <div class="input-prepend">
					{{ Form::textarea('info', $gallery->info, 
										array('class' => 'input-xxlarge adminTextarea ckeditor',
											  'rows' => '20')) }}
				</div>
			</div>
		</div>

		<div class="control-group">
			{{ Form::label('show-info', 'Active / deactive info text', array('class' => 'control-label')); }}
			<div class="controls">
			    <div class="input-prepend">
					{{ Form::checkbox('show-info', '1',$gallery->show_info) }}
				</div>
			</div>
		</div>

		<div class="control-group {{{ $errors->has('category_id') ? 'error' : '' }}}">
			<label class="control-label" for="name">Category name</label>
			<div class="controls">

				{{ Form::select('category_id', $categories, Input::old('category_id', $gallery->category_id)); }}
				{{ $errors->first('category_id', '<span class="help-inline">:message</span>') }}
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				{{ Form::reset('Reset',array('class'=>'btn')) }}
				{{ Form::submit('Publish',array('class'=>'btn btn-success')) }}
			</div>
		</div>
	</div>

{{ Form::close() }}
@stop