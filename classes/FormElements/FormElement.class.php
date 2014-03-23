<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/FormElement.class.php
 * @Purpose: Cette classe est la classe mère des classes 
 * d'éléments de formulaire HTML.
 * @Author: Lionel Guissani
 */
abstract class FormElement {
	/**
	 * @var Label de l'élément de formulaire
	 */
	protected $label;
	/**
	 * @var string Texte d'aide de l'élément de formulaire
	 */
	protected $help;

	/**
	 * Accesseur en lecture de l'attribut label
	 * @return Label Label
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * Accesseur en lecture de l'attribut label
	 * @param Label $label Nouveau label
	 */
	public function setLabel(Label $label) {
		$this->label = $label;
	}

	/**
	 * Accesseur en écriture de l'attribut help
	 * @param $help string Nouveau texte d'aide
	 */
	public function setHelp($help) {
		$this->help = $help;
	}

	/**
	 * Accesseur en lecture de l'attribut help
	 * @return string Texte d'aide
	 */
	public function getHelp() {
		return $this->help;
	}
}