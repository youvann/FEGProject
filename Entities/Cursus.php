<?php

class Cursus {

	private $id;
	private $idEtudiant;
	private $codeFormation;
	private $anneeDebut;
	private $anneeFin;
	private $cursus;
	private $etablissement;
	private $note;
	private $valide;

	function __construct($id, $idEtudiant, $codeFormation, $anneeDebut, $anneeFin, $cursus, $etablissement, $note, $valide) {
		$this->id = $id;
		$this->idEtudiant = $idEtudiant;
		$this->codeFormation = $codeFormation;
		$this->anneeDebut = $anneeDebut;
		$this->anneeFin = $anneeFin;
		$this->cursus = $cursus;
		$this->etablissement = $etablissement;
		$this->note = $note;
		$this->valide = $valide;
	}
	
	public function getId() {
		return $this->id;
	}

	public function getIdEtudiant() {
		return $this->idEtudiant;
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

	public function getValide() {
		return $this->valide;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setIdEtudiant($idEtudiant) {

		$this->idEtudiant = $idEtudiant;
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

	public function setValide($valide) {
		$this->valide = $valide;
	}
}
