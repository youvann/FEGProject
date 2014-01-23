<?php

class Voeu {
	private $codeEtape;
	private $codeFormation;
	private $etape;
	private $responsable;
	private $villes;
	
	function __construct($codeEtape, $codeFormation, $etape, $responsable) {
		$this->codeEtape = $codeEtape;
		$this->codeFormation = $codeFormation;
		$this->etape = $etape;
		$this->responsable = $responsable;
		$this->villes = NULL;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getEtape() {
		return $this->etape;
	}

	public function getResponsable() {
		return $this->responsable;
	}
	
	public function getVilles() {
		return $this->villes;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setCodeFormation($codeFormation) {
		$this->code = $codeFormation;
	}

	public function setEtape($etape) {
		$this->etape = $etape;
	}

	public function setResponsable($responsable) {
		$this->responsable = $responsable;
	}

	public function setVilles($villes) {
		$this->villes = $villes;
	}
}
