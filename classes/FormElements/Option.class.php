<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/Option.class.php
 * @Purpose: Cette classe représente une option dans une liste
 * déroulante HTML.
 * @Author: Lionel Guissani
 */
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
