<?php

class Formation {

	private $codeFormation;
	private $mention;
	private $faculte;
	
	function __construct($codeFormation, $mention, $faculte) {
		$this->codeFormation = $codeFormation;
		$this->mention = $mention;
		$this->faculte = $faculte;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getMention() {
		return $this->mention;
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

	public function setFaculte($faculte) {
		$this->faculte = $faculte;
	}
}
