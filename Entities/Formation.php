<?php

class Formation {

	private $codeFormation;
	private $mention;
	private $informations;
	private $modalites;
	private $faculte;
	
	function __construct($codeFormation, $mention, $informations, $modalites, $faculte) {
		$this->codeFormation = $codeFormation;
		$this->mention = $mention;
		$this->informations = $informations;
		$this->modalites = $modalites;
		$this->faculte = $faculte;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getMention() {
		return $this->mention;
	}

	public function getInformations() {
		return $this->informations;
	}

	public function getModalites() {
		return $this->modalites;
	}

	public function getFaculte() {
		return $this->faculte;
	}

	public function setCodeFormation($codeFormation) {
		$this->codeFormation = $codeFormation;
	}

	public function setMention($mention) {
		$this->mention = $mention;
	}

	public function setInformations($informations) {
		$this->informations = $informations;
	}

	public function setModalites($modalites) {
		$this->modalites = $modalites;
	}

	public function setFaculte($faculte) {
		$this->faculte = $faculte;
	}
}
