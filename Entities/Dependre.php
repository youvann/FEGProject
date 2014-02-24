<?php

class Dependre {

	private $idDossier;
	private $codeEtape;

	function __construct($idDossier, $codeEtape) {
		$this->idDossier = $idDossier;
		$this->codeEtape = $codeEtape;
	}

	/**
	 * @param mixed $idDossier
	 */
	public function setIdDossier($idDossier)
	{
		$this->idDossier = $idDossier;
	}

	/**
	 * @return mixed
	 */
	public function getIdDossier()
	{
		return $this->idDossier;
	}

	/**
	 * @param mixed $codeEtape
	 */
	public function setCodeEtape($codeEtape)
	{
		$this->codeEtape = $codeEtape;
	}

	/**
	 * @return mixed
	 */
	public function getCodeEtape()
	{
		return $this->codeEtape;
	}


}
