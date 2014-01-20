<?php

class Experience {
	private $id;
	private $ine;
	private $codeFormation;
	private $moisDebut;
	private $anneeDebut;
	private $moisFin;
	private $anneeFin;
	private $entreprise;
	private $fonction;

	function __construct($id, $ine, $codeFormation, $moisDebut, $anneeDebut, $moisFin, $anneeFin, $entreprise, $fonction) {
		$this->id = $id;
		$this->ine = $ine;
		$this->codeFormation = $codeFormation;
		$this->moisDebut = $moisDebut;
		$this->anneeDebut = $anneeDebut;
		$this->moisFin = $moisFin;
		$this->anneeFin = $anneeFin;
		$this->entreprise = $entreprise;
		$this->fonction = $fonction;
	}

	public function getId() {
		return $this->id;
	}

	public function getIne() {
		return $this->ine;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getMoisDebut() {
		return $this->moisDebut;
	}

	public function getAnneeDebut() {
		return $this->anneeDebut;
	}

	public function getMoisFin() {
		return $this->moisFin;
	}

	public function getAnneeFin() {
		return $this->anneeFin;
	}

	public function getEntreprise() {
		return $this->entreprise;
	}

	public function getFonction() {
		return $this->fonction;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setIne($ine) {
		$this->ine = $ine;
	}

	public function setCodeFormation($codeFormation) {
		$this->codeFormation = $codeFormation;
	}

	public function setMoisDebut($moisDebut) {
		$this->moisDebut = $moisDebut;
	}

	public function setAnneeDebut($anneeDebut) {
		$this->anneeDebut = $anneeDebut;
	}

	public function setMoisFin($moisFin) {
		$this->moisFin = $moisFin;
	}

	public function setAnneeFin($anneeFin) {
		$this->anneeFin = $anneeFin;
	}

	public function setEntreprise($entreprise) {
		$this->entreprise = $entreprise;
	}

	public function setFonction($fonction) {
		$this->fonction = $fonction;
	}


}
