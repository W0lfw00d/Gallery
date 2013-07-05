@extends('admin/default')

{{-- Web site Title --}}
@section('title')
	Gallery management | {{ $siteData['settings']['site_name'] }}
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Gallery management

		<div class="pull-right">
			<a href="{{{ URL::to('admin/gallery/create') }}}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

<table class="table table-condensed table-hover table-edit">
	<thead>
		<tr>
			<th class="span6">Title</th>
			<!--th class="span2">Category</th-->
			<th class="span4">Created at</th>
			<th class="span1">Edit</th>
			<th class="span1">Delete</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($galleries as $gallery)
		<tr>
			<td>{{ HTML::link('admin/gallery/' . $gallery->id . '/edit', $gallery->name ) }}</td>

			<!--td>{{-- HTML::link('admin/category/' . $gallery->category->id . '/edit', $gallery->category->name ) --}}</td-->
			<td>{{{ $gallery->created_at }}}</td>
			<td>
				<a href="{{{ URL::to('admin/gallery/' . $gallery->id . '/edit' ) }}}" class="btn btn-mini">Edit</a>
			</td>
			<td>
				{{ Form::open(array('url' => 'admin/gallery/'.$gallery->id,
						'method' => 'delete',
						'id' => 'deleteGallery'.$gallery->id
						)) }}
					{{ Form::submit('Delete',array('class'=>'btn btn-mini btn-danger confirmDelete')) }}
					{{ Form::hidden('galleryId', $gallery->id) }}
				{{ Form::close() }}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@stop