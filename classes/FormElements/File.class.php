<?php

/**
 * @Project: FEG Project
 * @File: /classes/FormElement/File.class.php
 * @Purpose: Cette classe représente une balise 
 * de téléchargement HTML vers serveur.
 * @Author: Lionel Guissani
 */
class File {

	private $id;
	private $name;
	private $value;

	public function __construct($id, $name, $value) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		return '<input class="form-control" type="file" id="' . $this->id . '" name="' . $this->name . '" /><input type="hidden" name="MAX_FILE_SIZE" value="100000">';
	}

}
