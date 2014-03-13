<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/Select.class.php
 * @Purpose: Cette classe représente une liste déroulante HTML.
 * @Author: Lionel Guissani
 */
class Select extends FormElement {
	/**
	 * @var string Identifiant de la liste déroulante
	 */
	private $id;
	/**
	 * @var string Nom de la liste déroulante
	 */
	private $name;
	/**
	 * @var array Options de la liste déroulante
	 */
	private $options;
	/**
	 * @var boolean Permet de savoir si liste déroulante est à choix multiples ou non
	 */
	private $multiple;

	/**
	 * Constructeur de la liste déroulante
	 * @param $id string Identifiant
	 * @param $name string Nom
	 */
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

	/**
	 * @return string Code HTML
	 */
	public function __toString() {
		$return = '<select class="form-control" id="' . $this->id . '" name="' . $this->name . '" ' . ($this->multiple === true ? 'multiple="multiple"' : '') . ' >';
		foreach ($this->options as $option) {
			$return .= $option;
		}
		return $return . '</select>';
	}

}