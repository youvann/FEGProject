<?php

abstract class FormElement {

	protected $label;

	public function getLabel() {
		return $this->label;
	}

	public function setLabel(Label $label) {
		$this->label = $label;
	}

}

class Option {

	private $label;
	private $value;

	public function __construct($value, $label) {
		$this->value = $value;
		$this->label = $label;
	}

	public function __toString() {
		return '<option value="' . $this->value . '">' . $this->label . '</option>';
	}

}

class File {

	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return '<input class="form-control" type="file" id="' . $this->id . '" name="' . $this->name . '" /><input type="hidden" name="MAX_FILE_SIZE" value="100000">';
	}

}