<?php

class InformationSupp {

	private $codeEtape;
	private $codeVet;
	private $id;
	private $libelInformation;
	private $requis;
	private $idTypeElement;

	function __construct($codeEtape, $codeVet, $id, $libelInformation, $requis, $idTypeElement) {
		$this->codeEtape = $codeEtape;
		$this->codeVet = $codeVet;
		$this->id = $id;
		$this->libelInformation = $libelInformation;
		$this->requis = $requis;
		$this->idTypeElement = $idTypeElement;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getCodeVet() {
		return $this->codeVet;
	}

	public function getId() {
		return $this->id;
	}

	public function getLibelInformation() {
		return $this->libelInformation;
	}

	public function getRequis() {
		return $this->requis;
	}

	public function getIdTypeElement() {
		return $this->idTypeElement;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setCodeVet($codeVet) {
		$this->codeVet = $codeVet;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setLibelInformation($libelInformation) {
		$this->libelInformation = $libelInformation;
	}

	public function setRequis($requis) {
		$this->requis = $requis;
	}

	public function setIdTypeElement($idTypeElement) {
		$this->idTypeElement = $idTypeElement;
	}

}
