<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/Label.class.php
 * @Purpose: Cette classe représente 
 * une libellé d'élément de formulaire HTML.
 * @Author: Lionel Guissani
 */
class Label {
	/**
	 * @var string Cible du label
	 */
	private $for;
	/**
	 * @var string Texte du label
	 */
	private $label;

	/**
	 * @param $for
	 * @param $label
	 */
	function __construct($for, $label) {
		$this->for = $for;
		$this->label = $label;
	}
	/**
	 * @return string
	 */
	public function __toString() {
		return '<label for="' . $this->for . '">' . $this->label . '</label>';
	}

	/**
	 * Accesseur en lecture de l'attribut for
	 * @return string Cible du label
	 */
	public function getFor() {
		return $this->for;
	}

	/**
	 * Accesseur en lecture de l'attribut label
	 * @return string Texte du label
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * Accesseur en écriture de l'attribut for
	 * @param $for string Nouvelle cible du label
	 */
	public function setFor($for) {
		$this->for = $for;
	}

	/**
	 * Accesseur en écriture de l'attribut label
	 * @param $label string Nouveau texte du label
	 */
	public function setLabel($label) {
		$this->label = $label;
	}
}