@extends('admin.default');

@section('nav_menu')
@stop

@section('content')
	{{ Form::open(array('url' => 'admin',
							'class' => 'form-horizontal',
							'autocomplete'=>"off")) }}

		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />


		<div class="input-pane">

			<div class="control-group {{{ $errors->has('name') ? 'error' : '' }}}">
				{{ Form::label('username', 'Username', array('class' => 'control-label')); }}
				<div class="controls">
					<input type="text" name="username" id="username" value="{{{ Input::old('username') }}}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group">
				{{ Form::label('password', 'Password', array('class' => 'control-label')); }}
				<div class="controls">
				   <input type="password" name="password" id="caption" value="" />
					{{ $errors->first('caption', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					{{ Form::reset('Reset',array('class'=>'btn btn-reset hidden')) }}
					{{ Form::submit('Enter',array('class'=>'btn btn-success')) }}
				</div>
			</div>
		</div>

	{{ Form::close() }}
@stop