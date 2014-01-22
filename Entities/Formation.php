<?php

class Formation {

	private $codeFormation;
	private $mention;
	private $ouverte;
	private $faculte;
	private $langue;

	function __construct($codeFormation, $mention, $ouverte, $faculte, $langue) {
		$this->codeFormation = $codeFormation;
		$this->mention = $mention;
		$this->ouverte = $ouverte;
		$this->faculte = $faculte;
		$this->langue = $langue;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getMention() {
		return $this->mention;
	}

	public function getOuverte() {
		return $this->ouverte;
	}

	public function getFaculte() {
		return $this->faculte;
	}

	public function getLangue() {
		return $this->langue;
	}

	public function setCode($codeFormation) {
		$this->codeFormation = $codeFormation;
	}

	public function setMention($mention) {
		$this->mention = $mention;
	}

	public function setOuverte($ouverte) {
		$this->ouverte = $ouverte;
	}

	public function setFaculte($faculte) {
		$this->faculte = $faculte;
	}

	public function setLangue($langue) {
		$this->langue = $langue;
	}

}
