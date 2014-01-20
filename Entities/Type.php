<?php

class Type {
	private $nom;
	private $libelle;
	
	function __construct($nom, $libelle) {
		$this->nom = $nom;
		$this->libelle = $libelle;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getLibelle() {
		return $this->libelle;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setLibelle($libelle) {
		$this->libelle = $libelle;
	}
}
