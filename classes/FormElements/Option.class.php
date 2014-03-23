<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/Option.class.php
 * @Purpose: Cette classe représente une option
 * dans une liste déroulante HTML.
 * @Author: Lionel Guissani
 */
class Option {
	/**
	 * @var string Libellé de l'option
	 */
	private $label;
	/**
	 * @var string Valeur de l'option
	 */
	private $value;
	/**
	 * Constructeur de l'option
	 * @param $value string Valeur
	 * @param $label string Libellé
	 */
	public function __construct($value, $label) {
		$this->value = $value;
		$this->label = $label;
	}
	/**
	 * @return string Code HTML de l'option
	 */
	public function __toString() {
		return '<option value="' . $this->value . '">' . $this->label . '</option>';
	}
}
