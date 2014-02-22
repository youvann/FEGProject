<?php

class DocumentSpecifique {
	private $id;
	private $dossierPdf;
	private $nom;
	private $url;
	
	function __construct($id, $dossierPdf, $nom, $url) {
		$this->id = $id;
		$this->dossierPdf = $dossierPdf;
		$this->nom = $nom;
		$this->url = $url;
	}

	public function getId() {
		return $this->id;
	}

	public function getDossierPdf() {
		return $this->dossierPdf;
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

	public function setDossierPdf($dossierPdf) {
		$this->dossierPdf = $dossierPdf;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setUrl($url) {
		$this->url = $url;
	}
}
