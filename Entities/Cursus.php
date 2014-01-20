<?php

class Cursus {

	private $id;
	private $ine;
	private $codeFormation;
	private $anneeDebut;
	private $anneeFin;
	private $etablissement;
	private $valide;

	function __construct($id, $ine, $codeFormation, $anneeDebut, $anneeFin, $etablissement, $valide) {
		$this->id = $id;
		$this->ine = $ine;
		$this->codeFormation = $codeFormation;
		$this->anneeDebut = $anneeDebut;
		$this->anneeFin = $anneeFin;
		$this->etablissement = $etablissement;
		$this->valide = $valide;
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
	
	public function getAnneeDebut() {
		return $this->anneeDebut;
	}

	public function getAnneeFin() {
		return $this->anneeFin;
	}

	public function getEtablissement() {
		return $this->etablissement;
	}

	public function getValide() {
		return $this->valide;
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

	public function setAnneeDebut($anneeDebut) {
		$this->anneeDebut = $anneeDebut;
	}

	public function setAnneeFin($anneeFin) {
		$this->anneeFin = $anneeFin;
	}

	public function setEtablissement($etablissement) {
		$this->etablissement = $etablissement;
	}

	public function setValide($valide) {
		$this->valide = $valide;
	}


}
