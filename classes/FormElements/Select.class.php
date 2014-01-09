<?php

class Select extends FormElement {

	private $id;
	private $name;
	private $options;
	private $multiple;

	public function __construct($id, $name) {
		$this->id = $id;
		$this->name = $name;
		$this->options = array();
	}

	public function addOption(Option $option) {
		$this->options[] = $option;
	}

	public function __toString() {
		$return = '<select class="form-control" id="' . $this->id . '" name="' . $this->name . '" ' . ($this->multiple === true ? 'multiple="multiple"' : '') . ' >';
		foreach ($this->options as $option) {
			$return .= $option;
		}
		return $return . '</select>';
	}

}