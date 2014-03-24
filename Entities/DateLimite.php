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
	 * @var string Date limite du dossier pdf en fonction de la titularisation
	 */
	private $date;

	/**
	 * Constructeur
	 * @param $dossierPdf string Identitiant du dossier pdf
	 * @param $titulaire string Identitiant de la titularisation
	 * @param $date string Date limite du dossier pdf en fonction de la titularisation
	 */
	function __construct($dossierPdf, $titulaire, $date)
	{
		$this->dossierPdf = $dossierPdf;
		$this->titulaire = $titulaire;
		$this->date = $date;
	}

	/**
	 * @param string $date Date limite du dossier pdf en fonction de la titularisation
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}

	/**
	 * @return string Date limite du dossier pdf en fonction de la titularisation
	 */
	public function getDate()
	{
		return $this->date;
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