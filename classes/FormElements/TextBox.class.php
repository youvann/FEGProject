<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/TextBox.class.php
 * @Purpose: Cette classe représente une zone de texte HTML.
 * @Author: Lionel Guissani
 */
class TextBox extends FormElement {
	/**
	 * @var Identifiant de la zone de texte HTML
	 */
	private $id;
	/**
	 * @var string Nom de la zone de texte HTML
	 */
	private $name;
	/**
	 * @var string Valeur de la zone de texte HTML
	 */
	private $value;

	/**
	 * Constructeur de la zone de texte HTML
	 * @param $id string Identifiant
	 * @param $name string Nom
	 * @param $value string Valeur
	 */
	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	/**
	 * @return string Code HTML de la zone de texte
	 */
	public function __toString() {
		return $this->getLabel() . '<input class="form-control" data-validation="custom" data-validation-regexp="^([0-9a-zA-Z/\-\'\séêèëààâäôœöûüùîïç]+)$" data-validation-error-msg="Un champ relatif aux informations spécifiques n\'a pas été rempli" type="text" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />';
	}

}