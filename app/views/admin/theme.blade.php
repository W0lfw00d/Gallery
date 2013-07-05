@extends('admin/default')

@section('pageTitle')
	Logo position | {{ $siteData['settings']['site_name'] }}
	@parent
@stop

@section('content')
<div class="page-header">
	<h3>Logo position</h3>
</div>

@include('admin.dropzone')

{{ Form::open(array('url' => 'admin/theme',
						'class' => 'form-horizontal',
						'autocomplete'=>"off")) }}
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

	{{ Form::hidden('logo',$siteData['settings']['logo'],array('id'=>'logo')) }}
	{{ Form::hidden('logoAlignClass',$siteData['settings']['logo-align-class'],array('id'=>'logoAlignClass')) }}

	<div class="logo-choice">
		<div class="index-logo logo-left">
			{{ HTML::image($siteData['settings']['logoUploadDir'].'/thumb/'.$siteData['settings']['logo']) }}
		</div>
		<div class="index-logo logo-right">
			{{ HTML::image($siteData['settings']['logoUploadDir'].'/thumb/'.$siteData['settings']['logo']) }}
		</div>
		<div class="index-logo logo-center">
			{{ HTML::image($siteData['settings']['logoUploadDir'].'/thumb/'.$siteData['settings']['logo']) }}
		</div>
	</div>

	<h2>Logo library</h2>
	<ul class="thumbnails connected" id="logoLibrary">
		<li>
		    <a href="#" class="thumbnail center-this use-logo-form" data-toggle="collapse" data-target="#uploadForm">
				{{ HTML::image('img/file_plus.png') }}
			</a>
		</li>
		@if(is_array($logoLibrary))
			@foreach($logoLibrary as $libImage)
				<li id="imgLib_{{{ pathinfo($libImage,PATHINFO_BASENAME) }}}">
				    <a href="#" class="thumbnail center-this">
						{{ HTML::image($siteData['settings']['logoUploadDir'] .'/small/'.pathinfo($libImage,PATHINFO_BASENAME)) }}
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