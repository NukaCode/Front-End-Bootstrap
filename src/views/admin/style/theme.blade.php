<div class="panel panel-inverse">
	<div class="panel-heading">
		<div class="panel-title">Customize the Site Theme</div>
	</div>
	<div class="panel-body">
		{{ bForm::open(false) }}
			{{ bForm::select('style', $availableThemes, $currentTheme, null, 'Style') }}
			{{ bForm::select('src', ['local' => 'Local', 'vendor' => 'Vendor'], $currentSrc, null, 'Source') }}
			@foreach ($colors as $color => $values)
				{{ bForm::color($color, $values['hex'], array('id' => $color .'Input'), $values['title']) }}
			@endforeach
			{{ bForm::submit('Save Changes') }}
		{{ bForm::close() }}
	</div>
</div>