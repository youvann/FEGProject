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

	public function getLabel() {
		return $this->label;
	}

	public function setLabel(Label $label) {
		$this->label = $label;
	}

}