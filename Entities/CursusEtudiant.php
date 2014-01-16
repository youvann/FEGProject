<?php

class CursusEtudiant {

	private $numIne;
	private $cursusSuivit;
	private $annee;
	private $etablissement;
	private $valide;
	private $codeEtape;
	private $codeVet;

	function __construct($numIne, $cursusSuivit, $annee, $etablissement, $valide, $codeEtape, $codeVet) {
		$this->numIne = $numIne;
		$this->cursusSuivit = $cursusSuivit;
		$this->annee = $annee;
		$this->etablissement = $etablissement;
		$this->valide = $valide;
		$this->codeEtape = $codeEtape;
		$this->codeVet = $codeVet;
	}

	public function getNumIne() {
		return $this->numIne;
	}

	public function getCursusSuivit() {
		return $this->cursusSuivit;
	}

	public function getAnnee() {
		return $this->annee;
	}

	public function getEtablissement() {
		return $this->etablissement;
	}

	public function getValide() {
		return $this->valide;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getCodeVet() {
		return $this->codeVet;
	}

	public function setNumIne($numIne) {
		$this->numIne = $numIne;
	}

	public function setCursusSuivit($cursusSuivit) {
		$this->cursusSuivit = $cursusSuivit;
	}

	public function setAnnee($annee) {
		$this->annee = $annee;
	}

	public function setEtablissement($etablissement) {
		$this->etablissement = $etablissement;
	}

	public function setValide($valide) {
		$this->valide = $valide;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setCodeVet($codeVet) {
		$this->codeVet = $codeVet;
	}

}
