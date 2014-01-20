<?php

class Information {
	private $id;
	private $nom; // TextBox
	private $code;
	private $libelle;
	private $explications;
	private $ordre;
	
	function __construct($id, $nom, $code, $libelle, $explications, $ordre) {
		$this->id = $id;
		$this->nom = $nom;
		$this->code = $code;
		$this->libelle = $libelle;
		$this->explications = $explications;
		$this->ordre = $ordre;
	}

	public function getId() {
		return $this->id;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getCode() {
		return $this->code;
	}

	public function getLibelle() {
		return $this->libelle;
	}

	public function getExplications() {
		return $this->explications;
	}

	public function getOrdre() {
		return $this->ordre;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public function setLibelle($libelle) {
		$this->libelle = $libelle;
	}

	public function setExplications($explications) {
		$this->explications = $explications;
	}

	public function setOrdre($ordre) {
		$this->ordre = $ordre;
	}
}