        <div class="controls">

		{{ Form::open(array('url' => 'contact',
						'id' => 'contactForm',
						'class'=>'form-horizontal')) }}

		<legend>Contact</legend>
		<!--div class="control-group">
			<div id="gender" name="gender" class="btn-group" data-toggle="buttons-radio">
                    <button type="button" class="btn">Male</button>
                    <button type="button" class="btn">Female</button>
            
			</div>
		</div-->
		
		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<div class="control-group">

			{{ Form::label('firstName', 'First Name', array('class' => 'control-label')); }}
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					{{ Form::text('firstName', Input::old('firstName'), array('class' => 'input-xlarge','placeholder'=>'Jane')) }}
					{{ $errors->first('firstName', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>
		<div class="control-group ">
			{{ Form::label('lastName', 'Last Name', array('class' => 'control-label')); }}
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					{{ Form::text('lastName', Input::old('lastName'), array('class' => 'input-xlarge','placeholder'=>'Doe')) }}
					{{ $errors->first('lastName', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>
		<div class="control-group">
	        {{ Form::label('email', 'Email', array('class' => 'control-label')); }}
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
					{{ Form::text('email', Input::old('email'), array('class' => 'input-xlarge','placeholder'=>'your@email.com')) }}
					{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>
		<div class="control-group">
	        {{ Form::label('phone', 'Phone', array('class' => 'control-label')); }}
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-bullhorn"></i></span>
					{{ Form::text('phone', Input::old('phone'), array('class' => 'input-xlarge','placeholder'=>'555-2368')) }}
				</div>
			</div>
		</div>
		<div class="control-group">
	        {{ Form::label('comment', 'Comment', array('class' => 'control-label')); }}
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-question-sign"></i></span>
					{{ Form::textarea('comment', Input::old('comment'), array('class' => 'input-xlarge','placeholder'=>'Your comment..','rows'=>'10')) }}
					{{ $errors->first('comment', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>
		
		<div class="control-group">
			<div>
				{{ Form::submit('Send message',array('class'=>'btn btn-inverse')) }}
			</div>
		</div>
		{{ Form::close() }}
