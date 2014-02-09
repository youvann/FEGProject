<?php

class Faire {
	private $codeEtape;
	private $ine;
	private $codeFormation;
	private $ordre;
	
	function __construct($codeEtape, $ine, $codeFormation, $ordre) {
		$this->codeEtape = $codeEtape;
		$this->ine = $ine;
		$this->codeFormation = $codeFormation;
		$this->ordre = $ordre;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getIne() {
		return $this->ine;
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

	public function setIne($ine) {
		$this->ine = $ine;
	}

	public function setCodeFormation($codeFormation) {
		$this->codeFormation = $codeFormation;
	}

	public function setOrdre($ordre) {
		$this->ordre = $ordre;
	}


}
