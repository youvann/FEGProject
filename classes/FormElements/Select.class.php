<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/Select.class.php
 * @Purpose: Cette classe représente une liste déroulante HTML.
 * @Author: Lionel Guissani
 */
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

	/**
	 * Ajoute un objet Option à la propriété $options.
	 * @param Option $option Instance de la classe Option.
	 */
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