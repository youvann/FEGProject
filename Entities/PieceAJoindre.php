<?php

class PieceAJoindre {
	private $libelPiece;
	private $codeEtape;
	private $codeVet;
	
	function __construct($libelPiece, $codeEtape, $codeVet) {
		$this->libelPiece = $libelPiece;
		$this->codeEtape = $codeEtape;
		$this->codeVet = $codeVet;
	}

	public function getLibelPiece() {
		return $this->libelPiece;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getCodeVet() {
		return $this->codeVet;
	}

	public function setLibelPiece($libelPiece) {
		$this->libelPiece = $libelPiece;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setCodeVet($codeVet) {
		$this->codeVet = $codeVet;
	}


}
