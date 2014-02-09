<?php

class Information {
	private $id;
	private $type;
	private $codeFormation;
	private $libelle;
	private $explications;
	private $ordre;
	
	function __construct($id, $type, $codeFormation, $libelle, $explications, $ordre) {
		$this->id = $id;
		$this->type = $type;
		$this->codeFormation = $codeFormation;
		$this->libelle = $libelle;
		$this->explications = $explications;
		$this->ordre = $ordre;
	}

	public function getId() {
		return $this->id;
	}

	public function getType() {
		return $this->type;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
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

	public function setType($type) {
		$this->type = $type;
	}

	public function setCode($codeFormation) {
		$this->codeFormation = $codeFormation;
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