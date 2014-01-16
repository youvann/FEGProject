<?php

class TypeChampsInformations {
	private $id;
	private $nomType;
	
	function __construct($id, $nomType) {
		$this->id = $id;
		$this->nomType = $nomType;
	}

	public function getId() {
		return $this->id;
	}

	public function getNomType() {
		return $this->nomType;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setNomType($nomType) {
		$this->nomType = $nomType;
	}


}
