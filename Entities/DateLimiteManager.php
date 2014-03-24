<?php

/**
 * @Project: FEG Project
 * @File   : /Entities/DateLimiteManager.php
 * @Purpose: Entité Date limite
 * @Author : Lionel Guissani
 */
class DateLimiteManager
{
	/**
	 * @var PDO Connexion à la base de données
	 */
	private $db;

	/**
	 * @param PDO $db Connexion à la base de données
	 */
	function __construct(PDO $db)
	{
		$this->setDb($db);
	}

	/**
	 * Accesseur en écriture de l'attribut db
	 *
	 * @param PDO $db
	 */
	public function setDb(PDO $db)
	{
		$this->db = $db;
	}

	/**
	 * Retourne les dates limites d'un dossier pdf
	 *
	 * @param DossierPdf $dossierPdf Dossier pdf
	 *
	 * @return array Cursus d'un dossier étudiant
	 */
	public function findAllByDossierPdf(DossierPdf $dossierPdf)
	{
		$lesDatesLimites = array();
		$q = $this->db->prepare("SELECT * FROM `date_limite` WHERE `DOSSIER_PDF` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();

		foreach ($rs as $dateLimite) {
			$lesDatesLimites[] = new DateLimite($dateLimite['DOSSIER_PDF'], $dateLimite['TITULAIRE'], $dateLimite['DATE']);
		}
		return $lesDatesLimites;
	}

	/**
	 * Enregistre une date limite
	 *
	 * @param DateLimite $dateLimite
	 *
	 * @return bool Résultat de l'opération
	 */
	public function insert(DateLimite $dateLimite)
	{
		return $this->db->prepare("INSERT INTO `date_limite` (`DOSSIER_PDF`, `TITULAIRE`, `DATE`) VALUES (?, ?, ?);")
			->execute(array(
				$dateLimite->getDossierPdf(),
				$dateLimite->getTitulaire(),
				$dateLimite->getDate()
			));
	}

	/**
	 * Supprime une date limite
	 *
	 * @param DateLimite $dateLimite
	 *
	 * @return bool Résultat de l'opération
	 */
	public function delete(DateLimite $dateLimite)
	{
		return $this->db->prepare("DELETE FROM `date_limite` WHERE `DOSSIER_PDF` = ? AND `TITULAIRE` = ?;")
			->execute(array(
				$dateLimite->getDossierPdf(),
				$dateLimite->getTitulaire()
			));
	}
}