<?php

class Form {

	private $method;
	private $action;
	private $uploadForm;
	private $formElements;

	public function __construct($method, $action, $uploadForm = false) {
		$this->method = $method;
		$this->action = $action;
		$this->uploadForm = $uploadForm;
	}

	public function addFormElement($formElement) {
		$this->formElements[] = $formElement;
	}

	public function __toString() {
		$return = '<form role="form" method="' . $this->method . '" action="' . $this->action . '"' . ($this->uploadForm === true ? ' enctype="multipart/form-data"' : '') . '>';
		foreach ($this->formElements as $formElement) {
			$return .= '<div class="form-group">' . $formElement . '</div>';
		}
		return $return . '<input class="btn btn-primary" type="submit" /></form>';
	}

}