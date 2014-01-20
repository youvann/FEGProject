<?php

class Voeu {
	private $codeEtape;
	private $code;
	private $etape;
	private $responsable;
	
	function __construct($codeEtape, $code, $etape, $responsable) {
		$this->codeEtape = $codeEtape;
		$this->code = $code;
		$this->etape = $etape;
		$this->responsable = $responsable;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getCode() {
		return $this->code;
	}

	public function getEtape() {
		return $this->etape;
	}

	public function getResponsable() {
		return $this->responsable;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public function setEtape($etape) {
		$this->etape = $etape;
	}

	public function setResponsable($responsable) {
		$this->responsable = $responsable;
	}


}
