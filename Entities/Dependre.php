<?php

class Dependre {

	private $codeFormationMere;
	private $codeEtapeMere;
	private $codeFormationFille;

	function __construct($codeFormationMere, $codeEtapeMere, $codeFormationFille) {
		$this->codeFormationMere = $codeFormationMere;
		$this->codeEtapeMere = $codeEtapeMere;
		$this->codeFormationFille = $codeFormationFille;
	}

	/**
	 * @param mixed $codeEtapeMere
	 */
	public function setCodeEtapeMere($codeEtapeMere) {
		$this->codeEtapeMere = $codeEtapeMere;
	}

	/**
	 * @return mixed
	 */
	public function getCodeEtapeMere() {
		return $this->codeEtapeMere;
	}

	/**
	 * @param mixed $codeFormationFille
	 */
	public function setCodeFormationFille($codeFormationFille) {
		$this->codeFormationFille = $codeFormationFille;
	}

	/**
	 * @return mixed
	 */
	public function getCodeFormationFille() {
		return $this->codeFormationFille;
	}

	/**
	 * @param mixed $codeFormationMere
	 */
	public function setCodeFormationMere($codeFormationMere) {
		$this->codeFormationMere = $codeFormationMere;
	}

	/**
	 * @return mixed
	 */
	public function getCodeFormationMere() {
		return $this->codeFormationMere;
	}


}
