@extends('admin/default')

@section('pageTitle')
	Edit the category: '{{$category->name}}'| {{ $siteData['settings']['site_name'] }}
	@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Edit the category: '{{$category->name}}'

		<div class="pull-right">
			<a href="{{{ URL::to('admin/category') }}}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>
{{ Form::open(array('url' => 'admin/category/'.$category->id,
						'method' => 'put',
						'class' => 'form-horizontal',
						'autocomplete'=>"off")) }}
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<!-- ./ csrf token -->

	<div class="tab-pane active" id="tab-general">
		<!-- Post Title -->
		<div class="control-group {{{ $errors->has('name') ? 'error' : '' }}}">
			<label class="control-label" for="name">Category name</label>
			<div class="controls">
				<input type="text" name="name" id="name" value="{{{ Input::old('title', $category->name) }}}" />
				{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
			</div>
		</div>
		<!-- ./ post name -->
	</div>

	<div class="control-group">
		<ul id="projectGallery">
			<li class="list-header">
				<span class="span9">Projects</span>
				<span class="span1">Edit</span>
				<span class="span2">Delete</span>
			</li>
			@foreach ($category->galleries()->orderBy('order')->get() as $gallery)
			<li>
				<span class="span9">
					<span class="handle">::</span>
					{{ HTML::link('admin/gallery/' . $gallery->id . '/edit', $gallery->name ) }}
				</span>
				<span class="span1">
					<a href="{{{ URL::to('admin/gallery/' . $gallery->id . '/edit' ) }}}" class="btn btn-mini">Edit</a>
				</span>
				<span class="span2">
						{{ Form::checkbox('gallery_ids[]', $gallery->id)}}
						{{ Form::hidden('gallery_order_ids[]', $gallery->id)}}
				</span>
			</li>
			@endforeach
		</ul>
		<div class=" span6">
			<a href="{{{ URL::to('admin/gallery/create') }}}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i>Create Project</a>
		</div>
	</div>
<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			{{ Form::reset('Reset',array('class'=>'btn')) }}
			{{ Form::submit('Publish',array('class'=>'btn btn-success')) }}
		</div>
	</div>
	<!-- ./ form actions -->
{{ Form::close() }}
@stop