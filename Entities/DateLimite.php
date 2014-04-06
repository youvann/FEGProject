<?php

/**
 * @Project: FEG Project
 * @File   : /Entities/DateLimite.php
 * @Purpose: Entité Date limite
 * @Author : Lionel Guissani
 */
class DateLimite
{
/**
* @var string Identitiant du dossier pdf
*/
	private $dossierPdf;
	/**
	 * @var string Identitiant de la titularisation
	 */
	private $titulaire;
	/**
	 * @var string Date limite du dossier pdf en fonction de la titularisation en candidature
	 */
	private $dateCandidature;
	/**
	 * @var string Date limite du dossier pdf en fonction de la titularisation en préinscription
	 */
	private $datePreinscription;

	/**
	 * Constructeur
	 * @param $dossierPdf string Identitiant du dossier pdf
	 * @param $titulaire string Identitiant de la titularisation
	 * @param $dateCandidature string Date limite du dossier pdf en fonction de la titularisation en candidature
	 * @param $datePreinscription string Date limite du dossier pdf en fonction de la titularisation en préinscription
	 */
	function __construct($dossierPdf, $titulaire, $dateCandidature, $datePreinscription)
	{
		$this->dossierPdf = $dossierPdf;
		$this->titulaire = $titulaire;
		$this->dateCandidature = $dateCandidature;
		$this->datePreinscription = $datePreinscription;
	}

	/**
	 * @param string $dateCandidature Date limite du dossier pdf en fonction de la titularisation en candidature
	 */
	public function setDateCandidature($dateCandidature)
	{
		$this->dateCandidature = $dateCandidature;
	}

	/**
	 * @return string Date limite du dossier pdf en fonction de la titularisation en candidature
	 */
	public function getDateCandidature()
	{
		return $this->dateCandidature;
	}

	/**
	 * @param string $datePreinscription Date limite du dossier pdf en fonction de la titularisation
	 */
	public function setDatePreinscription($datePreinscription)
	{
		$this->datePreinscription = $datePreinscription;
	}

	/**
	 * @return string Date limite du dossier pdf en fonction de la titularisation
	 */
	public function getDatePreinscription()
	{
		return $this->datePreinscription;
	}

	/**
	 * @param string $dossierPdf Identitiant du dossier pdf
	 */
	public function setDossierPdf($dossierPdf)
	{
		$this->dossierPdf = $dossierPdf;
	}

	/**
	 * @return string Identitiant du dossier pdf
	 */
	public function getDossierPdf()
	{
		return $this->dossierPdf;
	}

	/**
	 * @param string $titulaire Identitiant de la titularisation
	 */
	public function setTitulaire($titulaire)
	{
		$this->titulaire = $titulaire;
	}

	/**
	 * @return string Identitiant de la titularisation
	 */
	public function getTitulaire()
	{
		return $this->titulaire;
	}
}