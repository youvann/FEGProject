<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/TextArea.class.php
 * @Purpose: Cette classe représente une 
 * zone de texte multiligne HTML.
 * @Author: Lionel Guissani
 */
class TextArea extends FormElement {

	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return $this->getLabel() . '<textarea class="form-control" type="text" id="' . $this->id . '" name="' . $this->name . '">' . $this->value . '</textarea>';
	}

}