<?php

class Cursus {

	private $id;
	private $ine;
	private $codeFormation;
	private $anneeDebut;
	private $anneeFin;
	private $cursus;
	private $etablissement;
	private $note;

	function __construct($id, $ine, $codeFormation, $anneeDebut, $anneeFin, $cursus, $etablissement, $note) {
		$this->id = $id;
		$this->ine = $ine;
		$this->codeFormation = $codeFormation;
		$this->anneeDebut = $anneeDebut;
		$this->anneeFin = $anneeFin;
		$this->cursus = $cursus;
		$this->etablissement = $etablissement;
		$this->note = $note;
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
	
	public function getCursus() {
		return $this->cursus;
	}

	public function getEtablissement() {
		return $this->etablissement;
	}

	public function getNote() {
		return $this->note;
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
	
	public function setCursus($cursus) {
		$this->cursus = $cursus;
	}

	public function setEtablissement($etablissement) {
		$this->etablissement = $etablissement;
	}

	public function setNote($note) {
		$this->note = $note;
	}


}
