<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/Label.class.php
 * @Purpose: Cette classe représente 
 * une libellé d'élément de formulaire HTML.
 * @Author: Lionel Guissani
 */
class Label {
	private $for;
	private $label;

	function __construct($for, $label) {
		$this->for = $for;
		$this->label = $label;
	}

		public function __toString() {
		return '<label for="' . $this->for . '">' . $this->label . '</label>';
	}

	public function getFor() {
		return $this->for;
	}

	public function getLabel() {
		return $this->label;
	}

	public function setFor($for) {
		$this->for = $for;
	}

	public function setLabel($label) {
		$this->label = $label;
	}
}