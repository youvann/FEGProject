<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Dependre.php
 * @Purpose: Entité Dependre
 * @Author: Lionel Guissani
 */
class Dependre {
	/**
	 * @var string Identifiant du dossier pdf
	 */
	private $idDossier;
	/**
	 * @var string Code étape
	 */
	private $codeEtape;

	/**
	 * @param $idDossier string Identifiant du dossier pdf
	 * @param $codeEtape string Code étape
	 */
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
	 * @return string
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
