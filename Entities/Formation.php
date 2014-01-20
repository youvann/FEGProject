<?php

class Formation {
	private $code;
	private $mention;
	private $ouverte;
	
	function __construct($code, $mention, $ouverte) {
		$this->code = $code;
		$this->mention = $mention;
		$this->ouverte = $ouverte;
	}

	public function getCode() {
		return $this->code;
	}

	public function getMention() {
		return $this->mention;
	}

	public function getOuverte() {
		return $this->ouverte;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public function setMention($mention) {
		$this->mention = $mention;
	}

	public function setOuvert($ouverte) {
		$this->ouverte = $ouverte;
	}
}
