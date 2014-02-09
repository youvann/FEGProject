<?php

class Choix {
	private $id;
	private $information;
	private $texte;
	
	function __construct($id, $information, $texte) {
		$this->id = $id;
		$this->information = $information;
		$this->texte = $texte;
	}

	public function getId() {
		return $this->id;
	}

	public function getInformation() {
		return $this->information;
	}

	public function getTexte() {
		return $this->texte;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setInformation($information) {
		$this->information = $information;
	}

	public function setTexte($texte) {
		$this->texte = $texte;
	}


}
