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

}
