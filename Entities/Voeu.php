<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Voeu.php
 * @Purpose: Entité Voeu
 * @Author: Lionel Guissani
 */
class Voeu {
	/**
	 * @var string Code étape
	 */
	private $codeEtape;
	/**
	 * @var string Code formation
	 */
	private $codeFormation;
	/**
	 * @var string Etape
	 */
	private $etape;
	/**
	 * @var string Dossier pdf
	 */
	private $dossierPdf;

	/**
	 * Constructeur
	 * @param $codeEtape string Code étape
	 * @param $codeFormation string Code formation
	 * @param $etape string Etape
	 * @param $dossierPdf string Dossier pdf
	 */
	function __construct($codeEtape, $codeFormation, $etape, $dossierPdf) {
		$this->codeEtape = $codeEtape;
		$this->codeFormation = $codeFormation;
		$this->etape = $etape;
		$this->dossierPdf = $dossierPdf;
	}

	/**
	 * @param string $codeEtape Code Etape
	 */
	public function setCodeEtape($codeEtape)
	{
		$this->codeEtape = $codeEtape;
	}

	/**
	 * @return string Code Etape
	 */
	public function getCodeEtape()
	{
		return $this->codeEtape;
	}

	/**
	 * @param string $codeFormation Code Formation
	 */
	public function setCodeFormation($codeFormation)
	{
		$this->codeFormation = $codeFormation;
	}

	/**
	 * @return string Code Formation
	 */
	public function getCodeFormation()
	{
		return $this->codeFormation;
	}

	/**
	 * @param string $dossierPdf Dossier Pdf
	 */
	public function setDossierPdf($dossierPdf)
	{
		$this->dossierPdf = $dossierPdf;
	}

	/**
	 * @return string Dossier Pdf
	 */
	public function getDossierPdf()
	{
		return $this->dossierPdf;
	}

	/**
	 * @param string $etape Etape
	 */
	public function setEtape($etape)
	{
		$this->etape = $etape;
	}

	/**
	 * @return string Etape
	 */
	public function getEtape()
	{
		return $this->etape;
	}
}
