<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/RadioButton.class.php
 * @Purpose: Cette classe représente un bouton radio HTML.
 * @Author: Lionel Guissani
 */
class RadioButton extends FormElement {
	/**
	 * @var string Identifiant du bouton radio
	 */
	private $id;
	/**
	 * @var string Nom du bouton radio
	 */
	private $name;
	/**
	 * @var string Valeur du bouton radio
	 */
	private $value;
	/**
	 * @var string Etat (coché ou non) du bouton radio
	 */
	private $checked;

	/**
	 * Constructeur du bouton radio
	 * @param $id Identifiant
	 * @param $name Nom
	 * @param $value Valeur
	 */
	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
		$this->checked = false;
	}

	/**
	 * Accesseur en ecriture sur l'attribut checked
	 * @param $checked boolean Booléen pour cocher ou non le bouton radio
	 */
	public function setChecked($checked) {
		$this->checked = $checked;
	}

	/**
	 * @return string Code HTML du bouton radio
	 */
	public function __toString() {
		return '<div class="radio"><label '.$this->label->getFor().'><input type="radio" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" ' . ($this->checked === true ? 'checked' : '') . ' />' . $this->label->getLabel() . '</label></div>';
	}
}