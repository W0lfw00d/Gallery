@extends('admin/default')

@section('pageTitle')
	Create a new category | {{ $siteData['settings']['site_name'] }}
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Create a new category

		<div class="pull-right">
			<a href="{{{ URL::to('admin/category') }}}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>
{{ Form::open(array('url' => 'admin/category',
						'method' => 'post',
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
				<input type="text" name="name" id="name" value="{{{ Input::old('name') }}}" />
				{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
			</div>
		</div>
		<!-- ./ post name -->
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
