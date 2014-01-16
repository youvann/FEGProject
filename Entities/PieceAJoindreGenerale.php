<?php

class PieceAJoindreGenerale {
	private $id;
	private $libelPiece;
	
	function __construct($id, $libelPiece) {
		$this->id = $id;
		$this->libelPiece = $libelPiece;
	}

	public function getId() {
		return $this->id;
	}

	public function getLibelPiece() {
		return $this->libelPiece;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setLibelPiece($libelPiece) {
		$this->libelPiece = $libelPiece;
	}


}
