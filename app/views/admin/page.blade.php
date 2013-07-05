@extends('admin.default')

@section('pageTitle')
	Edit the '{{ $page->name }}' page | {{ $siteData['settings']['site_name'] }}
@stop

@section('content')
		<h1>{{ $page->name }}</h1>
		{{ Form::open(array('url' => 'admin/page/'.$page->id,
						'method' => 'put',
						'class' => 'form-horizontal',
						'autocomplete'=>"off")) }}
				<div class="control-group">

					<div class="controls">
					    <div class="input-prepend">
						<span class="add-on"><i class="icon-list"></i></span>
							{{ Form::textarea('content', $page->content, 
												array('class' => 'input-xxlarge adminTextarea',
													  'rows' => '20')) }}
						</div>
					</div>
				</div>

			{{ Form::reset('Reset',array('class'=>'btn')) }}
			{{ Form::submit('Save',array('class'=>'btn btn-success')) }}

		{{ Form::close() }}
@stop