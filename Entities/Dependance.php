<?php

class Dependance {

	private $codeEtapeMere;
	private $codeVetMere;
	private $codeEtapeFille;
	private $codeVetFille;

	function __construct($codeEtapeMere, $codeVetMere, $codeEtapeFille, $codeVetFille) {
		$this->codeEtapeMere = $codeEtapeMere;
		$this->codeVetMere = $codeVetMere;
		$this->codeEtapeFille = $codeEtapeFille;
		$this->codeVetFille = $codeVetFille;
	}

	public function getCodeEtapeMere() {
		return $this->codeEtapeMere;
	}

	public function getCodeVetMere() {
		return $this->codeVetMere;
	}

	public function getCodeEtapeFille() {
		return $this->codeEtapeFille;
	}

	public function getCodeVetFille() {
		return $this->codeVetFille;
	}

	public function setCodeEtapeMere($codeEtapeMere) {
		$this->codeEtapeMere = $codeEtapeMere;
	}

	public function setCodeVetMere($codeVetMere) {
		$this->codeVetMere = $codeVetMere;
	}

	public function setCodeEtapeFille($codeEtapeFille) {
		$this->codeEtapeFille = $codeEtapeFille;
	}

	public function setCodeVetFille($codeVetFille) {
		$this->codeVetFille = $codeVetFille;
	}

}
