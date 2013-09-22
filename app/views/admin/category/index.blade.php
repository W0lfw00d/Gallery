@extends('admin/default')

{{-- Web site Title --}}
@section('title')
	Category Management | {{ $siteData['settings']['site_name'] }}
@parent
@stop

{{-- Content --}}
@section('content')

<div class="page-header">
	<h3>
<!-- 		Project Management -->
	</h3>
</div>

{{ Form::open(array('action' => 'CategoryAdminController@postUpdateCategory',
					'class' => 'form-horizontal',
					'autocomplete'=>"off")) }}

	<div class="control-group">
		<ul id="categoryIndex" class="span10">
			<li class="list-header">
				<span class="span9">Title</span>
				<span class="span1">Edit</span>
				<span class="span2">Delete</span>
			</li>
			@foreach ($categories as $category)
			<li>
				<span class="span9">
					<span class="handle">::</span>
					{{ HTML::link('admin/category/' . $category->id . '/edit', $category->name ) }}
				</span>
				<span class="span1">
					<a href="{{{ URL::to('admin/category/' . $category->id . '/edit' ) }}}" class="btn btn-mini">Edit</a>
				</span>
				<span class="span2">
					{{ Form::checkbox('category_ids[]', $category->id)}}
					{{ Form::hidden('category_order_ids[]', $category->id)}}
				</span>
			</li>
			@endforeach
		</ul>
	</div>

	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Publish',array('class'=>'btn btn-success')) }}
		</div>
	</div>

{{ Form::close() }}

@stop