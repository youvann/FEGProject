<?php

class Faire {
	private $codeEtape;
	private $idEtudiant;
	private $codeFormation;
	private $ordre;
	
	function __construct($codeEtape, $idEtudiant, $codeFormation, $ordre) {
		$this->codeEtape = $codeEtape;
		$this->idEtudiant = $idEtudiant;
		$this->codeFormation = $codeFormation;
		$this->ordre = $ordre;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getIdEtudiant() {
		return $this->idEtudiant;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getOrdre() {
		return $this->ordre;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setIdEtudiant($idEtudiant) {
		$this->idEtudiant = $idEtudiant;
	}

	public function setCodeFormation($codeFormation) {
		$this->codeFormation = $codeFormation;
	}

	public function setOrdre($ordre) {
		$this->ordre = $ordre;
	}


}
