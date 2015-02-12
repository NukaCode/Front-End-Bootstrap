<?php 
namespace NukaCode\Bootstrap\Html;


class RemovedForm {

    public function remoteModalRouteIcon($route, $icon)
    {
        $inputOpen  = $this->getIconWrapperOpen();
        $inputClose = $this->getInputWrapperClose();

        return <<<EOT
$inputOpen
		<a role="button" href="#remoteModal" data-toggle="modal" data-remote="$route">
        <i class="$icon"></i>
    </a>
    $inputClose
EOT;

    }

    public function ajaxForm($formId, $message)
    {
        $this->formId = $formId;

        $this->setAjaxFormRequirements($message);

        return $this;
    }

    protected function setAjaxFormRequirements($message)
    {
        $this->addToSection('js', '
<script>
	$(\'#' . $this->formId . '\').AjaxSubmit({
		path:\'/' . $this->request->path() . '\',
		successMessage:\'' . $message . '\'
	});
</script>
		');
    }

    protected function createCheckbox($name, $value, $checked, $options, $label)
    {
        return '
		<div class="checkbox">
			<label>' .
               parent::checkbox($name, $value, $checked, $options) . ' ' . $label
               . '</label>
		</div>
		';
    }

    public function checkbox($name, $value, $checked = false, $options = [], $label = null)
    {
        switch ($this->type) {
            case 'horizontal':
                return '
					<div class="form-group">
						<div class="col-md-offset-' . $this->labelSize . ' col-md-' . $this->inputSize . '">' .
                       $this->createCheckbox($name, $value, $checked, $options, $label)
                       . '</div>
					</div>
				';
                break;
            default:
                return $this->createCheckbox($name, $value, $checked, $options, $label);
                break;
        }
    }

    public function select2($name, $optionsArray, $selected, $options = [], $label = null, $placeholder = null)
    {
        // Set up the attributes
        $options = $this->verifyAttributes('select2', $options);
        $multiple   = in_array('multiple', $options);

        // Create the default input
        $input = parent::select($name, $optionsArray, $selected, $options);

        // Add the jquery
        $this->setSelect2Requirements($options['id'], $placeholder, $multiple);

        return $this->createOutput($name, $label, $input);
    }

    protected function setSelect2Requirements($id, $placeholder, $multiple)
    {
        static $exists = false;

        if (! $exists) {
            $this->addToSection('css', $this->html->style('css/vendor/select2/select2.css'));
            $this->addToSection('css', $this->html->style('css/vendor/select2/select2-bootstrap.css'));
            $this->addToSection('jsInclude', $this->html->script('vendor/select2/select2.js'));

            $exists = true;
        }

        if ($multiple) {
            $script = <<<EOT
@parent
$('#$id').select2({placeholder: '$placeholder',allowClear: true});
EOT;
        } else {
            $script = <<<EOT
@parent
$('#$id')
			 .prepend('<option/>')
			 .val(function(){return $('[selected]',this).val() ;})
			 .select2({
				placeholder: '$placeholder',
				allowClear: true
			 });
EOT;
        }

        return $this->addToSection('onReadyJs', $script);
    }

    public function color($name, $value, $options = [], $label = null)
    {
        // Set up the attributes
        $options = $this->verifyAttributes('color', $options);

        // Set up the label
        $label = $this->setUpLabel($name, $label);

        // Create the default input
        $input = parent::text($name, $value, $options);

        $this->setColorRequirements();

        $formInput = '
		<div class="form-group">' .
                     $label .
                     $this->getInputWrapperOpen()
                     . '<div class="input-group">
					<span class="input-group-addon" id="colorPreview' . $name . '" style="background-color: ' . $value . ';">&nbsp;</span>' .
                     $input
                     . '</div>' .
                     $this->getInputWrapperClose()
                     . '</div>';

        return $formInput;
    }

    public function setColorRequirements()
    {
        static $exists = false;

        if (! $exists) {
            $this->addToSection('css', $this->html->style('css/vendor/colorpicker/css/bootstrap-colorpicker.min.css'));
            $this->addToSection('jsInclude', $this->html->script('js/vendor/bootstrap-colorpicker.js'));
            $this->addToSection('onReadyJs', '
$(\'.colorpicker\').colorpicker().on(\'changeColor\', function(ev){
	$(\'#colorPreview\'+ $(this).attr(\'name\')).css(\'background-color\', ev.color.toHex());
});
			');

            $exists = true;
        }
    }

    public function image($name, $existingImage = null, $label = null)
    {
        // make sure we have an image
        if ($existingImage == null) {
            $existingImage = '/img/no_user.png';
        }

        // Set up the label
        $label = $this->setUpLabel($name, $label);

        // Create the default input
        $input = parent::file($name);

        $this->setImageRequirements();
        $inputOpen  = $this->getInputWrapperOpen();
        $inputClose = $this->getInputWrapperClose();

        $formInput = <<<EOT
<div class="form-group">
	$label
	$inputOpen
		<div>
			<div class="fileinput fileinput-new text-center" data-provides="fileinput" style="width: 200px;">
				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					<img src="$existingImage" alt="..." />
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
				<div>
					<span class="btn btn-sm btn-primary btn-block btn-file">
						<span class="fileinput-new">Select image</span>
						<span class="fileinput-exists">Change</span>
						$input
					</span>
					<a href="javascript:void(0);" class="btn btn-sm btn-block btn-inverse fileinput-exists" data-dismiss="fileinput">Remove</a>
				</div>
			</div>
		</div>
	$inputClose
</div>
EOT;

        return $formInput;
    }

    public function setImageRequirements()
    {
        static $exists = false;

        if (! $exists) {
            $this->addToSection('jsInclude', $this->html->script('vendor/jasny-bootstrap/dist/js/jasny-bootstrap.min.js'));
            $this->addToSection('css', $this->html->style('vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css'));

            $exists = true;
        }
    }

    public function submit($value = null, $parameters = ['class' => 'btn btn-primary'])
    {
        if (! isset($parameters['class'])) {
            $parameters['class'] = 'btn btn-sm btn-primary';
        }

        return '<div class="form-group">' .
               $this->getSubmitWrapperOpen() .
               parent::submit($value, $parameters) .
               $this->getInputWrapperClose()
               . '</div>';
    }

    public function jsonSubmit($value = null, $parameters = ['class' => 'btn btn-sm btn-primary'])
    {
        if (! isset($parameters['id'])) {
            $parameters['id'] = 'jsonSubmit';
        }
        if (! isset($parameters['class'])) {
            $parameters['class'] = 'btn btn-sm btn-primary';
        }

        return '<div class="form-group">' .
               $this->getSubmitWrapperOpen() .
               parent::submit($value, $parameters) .
               $this->getInputWrapperClose()
               . '</div>';
    }

    public function submitReset($submitValue = 'Submit', $resetValue = 'Reset',
                                $submitParameters = ['class' => 'btn btn-sm btn-primary'],
                                $resetParameters = ['class' => 'btn btn-sm btn-inverse'])
    {
        return '<div class="form-group">' .
               $this->getSubmitWrapperOpen()
               . '<div class="btn-group">' .
               parent::submit($submitValue, $submitParameters) .
               parent::reset($resetValue, $resetParameters)
               . '</div>' .
               $this->getInputWrapperClose()
               . '</div>';
    }

    /**
     * @param string $submitValue
     * @param string $cancelValue
     * @param array  $submitParameters
     * @param array  $cancelParameters
     *
     * @return string
     */
    public function submitCancel($submitValue = 'Submit', $cancelValue = 'Cancel',
                                 $submitParameters = ['class' => 'btn btn-sm btn-primary'],
                                 $cancelParameters = ['class' => 'btn btn-sm btn-inverse'])
    {
        return '<div class="form-group">' .
               $this->getSubmitWrapperOpen()
               . '<div class="btn-group">' .
               parent::submit($submitValue, $submitParameters) .
               '<a href="javascript: void(0);" ' . $this->html->attributes($cancelParameters) . ' data-dismiss="modal">' . $cancelValue . '</a>'
               . '</div>' .
               $this->getInputWrapperClose()
               . '</div>';
    }

    protected function getSubmitWrapperOpen()
    {
        switch ($this->type) {
            case 'horizontal':
                return '<div class="col-md-offset-' . $this->labelSize . ' col-md-' . $this->inputSize . '">';
                break;
        }

        return null;
    }

}