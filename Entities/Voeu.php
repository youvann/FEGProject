<?php

class Voeu {
	private $codeEtape;
	private $codeFormation;
	private $etape;
	private $dossierPdf;
	
	function __construct($codeEtape, $codeFormation, $etape, $dossierPdf) {
		$this->codeEtape = $codeEtape;
		$this->codeFormation = $codeFormation;
		$this->etape = $etape;
		$this->dossierPdf = $dossierPdf;
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

	public function getDossierPdf()
	{
		return $this->dossierPdf;
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

	public function setDossierPdf($dossierPdf)
	{
		$this->dossierPdf = $dossierPdf;
	}
}
