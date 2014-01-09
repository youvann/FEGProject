<?php

class CheckBox extends FormElement {

	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return '<div class="checkbox"><label for="' . $this->label->getFor() . '"><input type="checkbox" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />' . $this->label->getLabel() . '</label></div>';
	}

}
