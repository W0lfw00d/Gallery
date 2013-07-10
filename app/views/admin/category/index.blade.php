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

		<div class="pull-right">
			<a href="{{{ URL::to('admin/category/create') }}}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

<table class="table table-condensed table-hover table-edit">
	<thead>
		<tr>
			<th class="span6">Title</th>
			<th class="span4">Created at</th>
			<th class="span1">Edit</th>
			<th class="span1">Delete</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($categories as $category)
		<tr>
			<td>{{ HTML::link('admin/category/' . $category->id . '/edit', $category->name ) }}</td>
			<td>{{{ $category->created_at }}}</td>
			<td>
				<a href="{{{ URL::to('admin/category/' . $category->id . '/edit' ) }}}" class="btn btn-mini">Edit</a>
			</td>
			<td>
				{{ Form::open(array('url' => 'admin/category/'.$category->id,
						'method' => 'delete',
						'id' => 'deleteCategory'.$category->id
						)) }}
					{{ Form::submit('Delete',array('class'=>'btn btn-mini btn-danger confirmDelete')) }}
					{{ Form::hidden('categoryId', $category->id) }}
				{{ Form::close() }}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@stop