<?php

class DocumentSpecifique {
	private $id;
	private $code;
	private $nom;
	private $url;
	
	function __construct($id, $code, $nom, $url) {
		$this->id = $id;
		$this->code = $code;
		$this->nom = $nom;
		$this->url = $url;
	}

	public function getId() {
		return $this->id;
	}

	public function getCode() {
		return $this->code;
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

	public function setCode($code) {
		$this->code = $code;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setUrl($url) {
		$this->url = $url;
	}


}
