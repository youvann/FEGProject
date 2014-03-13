<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DocumentSpecifiqueManager.php
 * @Purpose: Entité DocumentSpecifique
 * @Author: Lionel Guissani
 */
class DocumentSpecifiqueManager
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
	 * @param PDO $db
	 */
	public function setDb(PDO $db)
	{
		$this->db = $db;
	}

	/**
	 * Récupère un document spécifique en fonction de son identifiant
	 * @param $id string Identifiant du document spécifique
	 * @return Choix Choix
	 */
	public function find($id)
	{
		$q = $this->db->prepare("SELECT * FROM `document_specifique` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new DocumentSpecifique($rs['ID'], $rs['DOSSIER_PDF'], $rs['NOM'], $rs['VISIBLE'], $rs['URL']);
	}

	/**
	 * Récupère tous les documents spécifiques en fonction d'un dossier pdf
	 * @param DossierPdf $dossierPdf Dossier Pdf
	 * @return array Tous les documents spécifiques en fonction d'un dossier pdf
	 */
	public function findAllByDossierPdf(DossierPdf $dossierPdf)
	{
		$documentsSpecifiques = array();
		$q = $this->db->prepare("SELECT * FROM `document_specifique` WHERE `DOSSIER_PDF` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $documentSpecifique) {
			$documentsSpecifiques[] = new DocumentSpecifique($documentSpecifique['ID'], $documentSpecifique['DOSSIER_PDF'], $documentSpecifique['NOM'], $documentSpecifique['VISIBLE'], $documentSpecifique['URL']);
		}
		return $documentsSpecifiques;
	}

	/**
	 * Récupère tous les documents spécifiques en fonction d'un dossier pdf demandés en préinscription
	 * @param DossierPdf $dossierPdf Dossier Pdf
	 * @return array Tous les documents spécifiques en fonction d'un dossier pdf demandés en préinscription
	 */
	public function findAllByDossierPdfVisible(DossierPdf $dossierPdf)
	{
		$documentsSpecifiques = array();
		$q = $this->db->prepare("SELECT * FROM `document_specifique` WHERE `DOSSIER_PDF` = ? AND `VISIBLE` = 1;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $documentSpecifique) {
			$documentsSpecifiques[] = new DocumentSpecifique($documentSpecifique['ID'], $documentSpecifique['DOSSIER_PDF'], $documentSpecifique['NOM'], $documentSpecifique['VISIBLE'], $documentSpecifique['URL']);
		}
		return $documentsSpecifiques;
	}

	/**
	 * Enregistre un document spécifique
	 * @param DocumentSpecifique $documentSpecifique
	 * @return bool Résultat de l'opération
	 */
	public function insert(DocumentSpecifique $documentSpecifique)
	{
		return $this->db->prepare("INSERT INTO `document_specifique` (`DOSSIER_PDF`, `NOM`, `URL`, `VISIBLE`) VALUES (?, ?, ?, ?);")
			->execute(array(
				$documentSpecifique->getDossierPdf(),
				$documentSpecifique->getNom(),
				$documentSpecifique->getUrl(),
				$documentSpecifique->getVisible()
			));
	}

	/**
	 * Met à jour un document spécifique
	 * @param DocumentSpecifique $documentSpecifique
	 * @return bool Résultat de l'opération
	 */
	public function update(DocumentSpecifique $documentSpecifique)
	{
		return $this->db->prepare("UPDATE `document_specifique` SET `DOSSIER_PDF` = ?, `NOM` = ?, `VISIBLE` = ?, `URL` = ? WHERE `ID` = ?;")
			->execute(array(
				$documentSpecifique->getDossierPdf(),
				$documentSpecifique->getNom(),
				$documentSpecifique->getVisible(),
				$documentSpecifique->getUrl(),
				$documentSpecifique->getId()
			));
	}

	/**
	 * Supprime un document spécifique
	 * @param DocumentSpecifique $documentSpecifique
	 * @return bool Résultat de l'opération
	 */
	public function delete(DocumentSpecifique $documentSpecifique)
	{
		return $this->db->prepare("DELETE FROM `document_specifique` WHERE `ID` = ?;")
			->execute(array($documentSpecifique->getId()));
	}

}
