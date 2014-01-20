<?php

class SeDerouler {
	private $codeVet;
	private $codeEtape;
	
	function __construct($codeVet, $codeEtape) {
		$this->codeVet = $codeVet;
		$this->codeEtape = $codeEtape;
	}

	public function getCodeVet() {
		return $this->codeVet;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function setCodeVet($codeVet) {
		$this->codeVet = $codeVet;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}


}
