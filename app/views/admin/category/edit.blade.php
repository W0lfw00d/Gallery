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
		<table class="table table-condensed table-hover table-edit">
			<thead>
				<tr>
					<th class="span6">Projects</th>
					<!--th class="span2">Category</th>
					<th class="span4">Created at</th-->
					<th class="span1">Edit</th>
					<th class="span1">Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($category->galleries()->orderBy('order')->get() as $gallery)
				<tr>
					<td>{{ HTML::link('admin/gallery/' . $gallery->id . '/edit', $gallery->name ) }}</td>

					<!--td>{{-- HTML::link('admin/category/' . $gallery->category->id . '/edit', $gallery->category->name ) --}}</td>
					<td>{{{-- $gallery->created_at --}}}</td-->
					<td>
						<a href="{{{ URL::to('admin/gallery/' . $gallery->id . '/edit' ) }}}" class="btn btn-mini">Edit</a>
					</td>
					<td>
							{{ Form::checkbox('gallery_ids[]', $gallery->id)}}
					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="4">
						<a href="{{{ URL::to('admin/gallery/create') }}}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i>Create Project</a>
						</td>
				</tr>
			</tbody>
		</table>
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