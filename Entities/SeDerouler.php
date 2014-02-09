<?php

class SeDerouler {
	private $id;
	private $codeEtape;
	
	function __construct($id, $codeEtape) {
		$this->id = $id;
		$this->codeEtape = $codeEtape;
	}

	public function getId() {
		return $this->id;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}


}
