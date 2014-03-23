<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/CheckBox.class.php
 * @Purpose: Cette classe représente une case à cocher HTML.
 * @Author: Lionel Guissani
 */
class CheckBox extends FormElement {
	/**
	 * @var string Identifiant de la case à cocher
	 */
	private $id;
	/**
	 * @var string Nom de la case à cocher
	 */
	private $name;
	/**
	 * @var string Valeur de la case à cocher
	 */
	private $value;

	/**
	 * Constructeur de la case à cocher
	 * @param $id Identifiant
	 * @param $name Nom
	 * @param $value Valeur
	 */
	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	/**
	 * @return string Code HTML de la case à cocher
	 */
	public function __toString() {
		return '<div class="checkbox"><label for="' . $this->label->getFor() . '"><input type="checkbox" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />' . $this->label->getLabel() . '</label></div>';
		
	}
}
