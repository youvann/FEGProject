<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/File.class.php
 * @Purpose: Cette classe représente une balise 
 * de téléchargement HTML vers serveur.
 * @Author: Lionel Guissani
 */
class File {
	/**
	 * @var string Identifiant de l'élément d'upload
	 */
	private $id;
	/**
	 * @var string Nom de l'élément d'upload
	 */
	private $name;
	/**
	 * @var string Valeur de l'élément d'upload
	 */
	private $value;

	/**
	 * Constructeur de l'élément d'upload
	 * @param $id string Identifiant
	 * @param $name string Nom
	 * @param $value String Valeur
	 */
	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	/**
	 * @return string Code HTML de l'élément d'upload
	 */
	public function __toString() {
		return '<input class="form-control" type="file" id="' . $this->id . '" name="' . $this->name . '" /><input type="hidden" name="MAX_FILE_SIZE" value="100000">';
	}

}
