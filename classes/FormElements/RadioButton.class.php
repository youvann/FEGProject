<?php

class RadioButton extends FormElement {

	private $id;
	private $name;
	private $value;
	private $checked;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
		$this->checked = false;
	}
	
	public function setChecked($checked) {
		$this->checked = $checked;
	}
	public function __toString() {
		return '<div class="radio"><label '.$this->label->getFor().'><input type="radio" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" ' . ($this->checked === true ? 'checked' : '') . ' />' . $this->label->getLabel() . '</label></div>';
	}

}