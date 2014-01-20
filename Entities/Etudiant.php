<?php

class Etudiant {

	private $ine;
	private $nombreDepots;

	function __construct($ine, $nombreDepots) {
		$this->ine = $ine;
		$this->nombreDepots = $nombreDepots;
	}

	public function getIne() {
		return $this->ine;
	}

	public function getNombreDepots() {
		return $this->nombreDepots;
	}

	public function setIne($ine) {
		$this->ine = $ine;
	}

	public function setNombreDepots($nombreDepots) {
		$this->nombreDepots = $nombreDepots;
	}
}
