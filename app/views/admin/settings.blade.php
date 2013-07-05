@extends('admin.default')

@section('pageTitle')
	Edit settings | {{ $siteData['settings']['site_name'] }}
@stop

@section('content')
		<h1>Settings</h1>
	{{-- Form::model('gallery') --}}
		{{ Form::open(array('id' => 'settingsForm',
							'class'=>'form-horizontal control-label')) }}

			@for($i=0;$i<count($editSettings);$i++)

				<div class="control-group">
					{{ Form::label('setting['.$editSettings[$i]->id.']', $editSettings[$i]->name,array('class'=>'control-label')) }}
					<div class="controls">
					    <div class="input-prepend">
						<span class="add-on"><i class="icon-wrench"></i></span>
							{{ Form::text('setting['.$editSettings[$i]->id.']', $editSettings[$i]->value, array('class' => 'input-xlarge')) }}
						</div>
					</div>
				</div>
			
			@endfor

			{{ Form::reset('Reset',array('class'=>'btn')) }}
			{{ Form::submit('Save settings',array('class'=>'btn btn-success')) }}

		{{ Form::close() }}
@stop