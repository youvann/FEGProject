<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DiplomeManager.php
 * @Purpose: Entité Diplome
 * @Author: Lionel Guissani
 */
class DiplomeManager
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
	 * Récupère un Diplôme en fonction de son identifiant
	 * @param $id string Identifiant du Diplôme
	 * @return Diplome Diplôme
	 */
	public function find($id)
	{
		$q = $this->db->prepare("SELECT * FROM `diplome_hors_feg` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Diplome($rs['ID'], $rs['NOM'], $rs['DOSSIER_PDF']);
	}

	/**
	 * Retourne tous les Diplomes qui dépendent du dossier pdf passé en paramètre
	 * @param DossierPdf $dossierPdf Dossier Pdf
	 * @return array Tous les Diplomes qui dépendent du dossier pdf passé en paramètre
	 */
	public function findAllByDossierPdf(DossierPdf $dossierPdf)
	{
		$diplomes = array();
		$q = $this->db->prepare("SELECT * FROM `diplome_hors_feg` WHERE `DOSSIER_PDF` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $diplome) {
			$diplomes[] = new Diplome($diplome['ID'], $diplome['NOM'], $diplome['DOSSIER_PDF']);
		}
		return $diplomes;
	}

	/**
	 * Enregistre un Diplome
	 * @param Diplome $diplome
	 * @return bool Résultat de l'opération
	 */
	public function insert(Diplome $diplome)
	{
		return $this->db->prepare("INSERT INTO `diplome_hors_feg` (`NOM`, `DOSSIER_PDF`) VALUES (?, ?);")->execute(array($diplome->getNom(), $diplome->getDossierPdf()));
	}

	/**
	 * Met à jour un Diplome
	 * @param Diplome $diplome
	 * @return bool Résultat de l'opération
	 */
	public function update(Diplome $diplome)
	{
		return $this->db->prepare("UPDATE `diplome_hors_feg` SET `NOM` = ?, `DOSSIER_PDF` = ? WHERE `ID` = ?;")->execute(array($diplome->getNom(), $diplome->getDossierPdf(), $diplome->getId()));
	}

	/**
	 * Supprime un Diplome
	 * @param Diplome $diplome
	 * @return bool Résultat de l'opération
	 */
	public function delete(Diplome $diplome)
	{
		return $this->db->prepare("DELETE FROM `diplome_hors_feg` WHERE `ID` = ?;")->execute(array($diplome->getId()));
	}
}
