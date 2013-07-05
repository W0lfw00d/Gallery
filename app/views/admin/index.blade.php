@extends('admin/default')

@section('pageTitle')
	Edit the index page | {{ $siteData['settings']['site_name'] }}
	@parent
@stop

@section('content')
<div class="page-header">
	<h3>Index page overview</h3>
</div>

@include('admin.dropzone')

{{ Form::open(array('url' => 'admin/index',
						'class' => 'form-horizontal',
						'autocomplete'=>"off")) }}
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	{{ Form::hidden('background',$siteData['settings']['indexBackground'],array('id'=>'background')) }}
	{{ Form::hidden('foreground',$siteData['settings']['indexForeground'],array('id'=>'foreground')) }}

	<div class="center-this index-background">
		{{ HTML::image($siteData['settings']['backgroundUploadDir'].'/large/'.$siteData['settings']['indexBackground']) }}
		<div class="ff center-this index-foreground">
				{{ HTML::image($siteData['settings']['foregroundUploadDir'].'/'.$siteData['settings']['indexForeground']) }}
		</div>
	</div>

	<h2>Foreground library</h2>
	<ul class="thumbnails connected" id="foregroundLibrary">
		<li>
		    <a href="#" class="thumbnail center-this use-foreground-form" data-toggle="collapse" data-target="#uploadForm">
				{{ HTML::image('img/file_plus.png') }}
			</a>
		</li>
		@if(is_array($foregroundLibrary))
			@foreach($foregroundLibrary as $libImage)
				<li id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['foregroundUploadDir'] .'/'.pathinfo($libImage,PATHINFO_BASENAME)) }}
					</a>
				</li>
			@endforeach
		@endif
	</ul>

	<h2>Background library</h2>
	<ul class="thumbnails connected" id="backgroundLibrary">
		<li>
		    <a href="#" class="thumbnail center-this use-background-form" data-toggle="collapse" data-target="#uploadForm">
				{{ HTML::image('img/file_plus.png') }}
			</a>
		</li>
		@if(is_array($backgroundLibrary))
			@foreach($backgroundLibrary as $libImage)
				<li id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['backgroundUploadDir'] .'/large/'.pathinfo($libImage,PATHINFO_BASENAME)) }}
					</a>
				</li>
			@endforeach
		@endif
	</ul>

	<div class="input-pane">
		<div class="control-group">
			<div class="controls">
				{{ Form::submit('Save',array('class'=>'btn btn-success')) }}
			</div>
		</div>
	</div>

{{ Form::close() }}
@stop