<?php

class DocumentSpecifique {
	private $id;
	private $codeFormation;
	private $nom;
	private $url;
	
	function __construct($id, $codeFormation, $nom, $url) {
		$this->id = $id;
		$this->codeFormation = $codeFormation;
		$this->nom = $nom;
		$this->url = $url;
	}

	public function getId() {
		return $this->id;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getUrl() {
		return $this->url;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setCodeFormation($codeFormation) {
		$this->codeFormation = $codeFormation;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setUrl($url) {
		$this->url = $url;
	}
}
