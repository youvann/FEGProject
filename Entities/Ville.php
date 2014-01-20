<?php

class Ville {
	private $codeVet;
	private $nom;

	function __construct($codeVet, $nom) {
		$this->codeVet = $codeVet;
		$this->nom = $nom;
	}

	public function getCodeVet() {
		return $this->codeVet;
	}

	public function getNom() {
		return $this->nom;
	}

	public function setCodeVet($codeVet) {
		$this->codeVet = $codeVet;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}
}
