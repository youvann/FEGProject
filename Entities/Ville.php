<?php

class Ville {
	private $id;
	private $nom;

	function __construct($id, $nom) {
		$this->id = $id;
		$this->nom = $nom;
	}

	public function getId() {
		return $this->codeVet;
	}

	public function getNom() {
		return $this->nom;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}
}
