<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/TextBox.class.php
 * @Purpose: Cette classe représente une zone de texte HTML.
 * @Author: Lionel Guissani
 */
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
		return $this->getLabel() . '<input class="form-control required" data-validation="required" data-validation-error-msg="Un champ relatif aux informations spécifiques n\'a pas été rempli" type="text" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />';
	}

}