<div class="panel panel-inverse">
	<div class="panel-heading">
		<div class="panel-title">Customize the Site Theme</div>
	</div>
	<div class="panel-body">
		{{ Form::open() }}
			@foreach ($colors as $color => $values)
                {{ Form::groupOpen() }}
				    {{ Form::color($color, $values['hex'], array('id' => $color .'Input'), $values['title']) }}
                {{ Form::groupClose() }}
			@endforeach
            {{ Form::offsetGroupOpen() }}
			    {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::offsetGroupClose() }}
		{{ Form::close() }}
	</div>
</div>