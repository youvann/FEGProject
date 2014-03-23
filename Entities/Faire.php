<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Faire.php
 * @Purpose: Entité Faire
 * @Author: Lionel Guissani
 */
class Faire {
	/**
	 * @var string Code étape
	 */
	private $codeEtape;
	/**
	 * @var string Identifiant de l'étudiant
	 */
	private $idEtudiant;
	/**
	 * @var string Code formation
	 */
	private $codeFormation;
	/**
	 * @var string Ordre
	 */
	private $ordre;

	/**
	 * Constructeur
	 * @param $codeEtape string Code étape
	 * @param $idEtudiant string Identifiant de l'étudiant
	 * @param $codeFormation string Code formation
	 * @param $ordre string Ordre
	 */
	function __construct($codeEtape, $idEtudiant, $codeFormation, $ordre) {
		$this->codeEtape = $codeEtape;
		$this->idEtudiant = $idEtudiant;
		$this->codeFormation = $codeFormation;
		$this->ordre = $ordre;
	}

	/**
	 * @param string $codeEtape
	 */
	public function setCodeEtape($codeEtape)
	{
		$this->codeEtape = $codeEtape;
	}

	/**
	 * @return string
	 */
	public function getCodeEtape()
	{
		return $this->codeEtape;
	}

	/**
	 * @param string $codeFormation
	 */
	public function setCodeFormation($codeFormation)
	{
		$this->codeFormation = $codeFormation;
	}

	/**
	 * @return string
	 */
	public function getCodeFormation()
	{
		return $this->codeFormation;
	}

	/**
	 * @param string $idEtudiant
	 */
	public function setIdEtudiant($idEtudiant)
	{
		$this->idEtudiant = $idEtudiant;
	}

	/**
	 * @return string
	 */
	public function getIdEtudiant()
	{
		return $this->idEtudiant;
	}

	/**
	 * @param string $ordre
	 */
	public function setOrdre($ordre)
	{
		$this->ordre = $ordre;
	}

	/**
	 * @return string
	 */
	public function getOrdre()
	{
		return $this->ordre;
	}

}
