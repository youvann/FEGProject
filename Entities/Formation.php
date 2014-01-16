<?php

class Formation {

	private $mention;
	private $etape;
	private $codeDiplome;
	private $codeEtape;
	private $codeVet;
	private $responsable;
	private $ville;
	private $faculte;
	private $languePdf;

	function __construct($mention, $etape, $codeDiplome, $codeEtape, $codeVet, $responsable, $ville, $faculte, $languePdf) {
		$this->mention = $mention;
		$this->etape = $etape;
		$this->codeDiplome = $codeDiplome;
		$this->codeEtape = $codeEtape;
		$this->codeVet = $codeVet;
		$this->responsable = $responsable;
		$this->ville = $ville;
		$this->faculte = $faculte;
		$this->languePdf = $languePdf;
	}

	public function getMention() {
		return $this->mention;
	}

	public function getEtape() {
		return $this->etape;
	}

	public function getCodeDiplome() {
		return $this->codeDiplome;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getCodeVet() {
		return $this->codeVet;
	}

	public function getResponsable() {
		return $this->responsable;
	}

	public function getVille() {
		return $this->ville;
	}

	public function getFaculte() {
		return $this->faculte;
	}

	public function getLanguePdf() {
		return $this->languePdf;
	}

	public function setMention($mention) {
		$this->mention = $mention;
	}

	public function setEtape($etape) {
		$this->etape = $etape;
	}

	public function setCodeDiplome($codeDiplome) {
		$this->codeDiplome = $codeDiplome;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setCodeVet($codeVet) {
		$this->codeVet = $codeVet;
	}

	public function setResponsable($responsable) {
		$this->responsable = $responsable;
	}

	public function setVille($ville) {
		$this->ville = $ville;
	}

	public function setFaculte($faculte) {
		$this->faculte = $faculte;
	}

	public function setLanguePdf($languePdf) {
		$this->languePdf = $languePdf;
	}

}
