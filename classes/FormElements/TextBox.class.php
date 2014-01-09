<?php

class TextBox extends FormElement {
	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return $this->getLabel() . '<input class="form-control" type="text" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />';
	}

}