<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/FormElement.class.php
 * @Purpose: Cette classe est la classe mère des classes 
 * d'éléments de formulaire HTML.
 * @Author: Lionel Guissani
 */
abstract class FormElement {

	protected $label;
	protected $help;

	public function getLabel() {
		return $this->label;
	}

	public function setLabel(Label $label) {
		$this->label = $label;
	}

	public function setHelp($help) {
		$this->help = $help;
	}
	public function getHelp() {
		return $this->help;
	}
}