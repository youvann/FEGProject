<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DependreManager.php
 * @Purpose: Entité Dependre
 * @Author: Lionel Guissani
 */
class DependreManager {
	/**
	 * @var PDO Connexion à la base de données
	 */
	private $db;

	/**
	 * @param PDO $db Connexion à la base de données
	 */
	function __construct(PDO $db) {
		$this->setDb($db);
	}

	/**
	 * Accesseur en écriture de l'attribut db
	 * @param PDO $db
	 */
	public function setDb(PDO $db) {
		$this->db = $db;
	}

	/**
	 * Retourne les étapes qui dépendent du dossier pdf passé en paramètre
	 * @param DossierPdf $dossierPdf Dossier pdf
	 * @return array Etapes qui dépendent du dossier pdf passé en paramètre
	 */
	public function findEtapes(DossierPdf $dossierPdf) {
		$dependances = array();
		$q = $this->db->prepare("SELECT * FROM `dependre` WHERE `ID_DOSSIER` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();

		foreach ($rs as $dependance) {
			$dependances[] = new Dependre($dependance['ID_DOSSIER'], $dependance['CODE_ETAPE']);
		}
		return $dependances;
	}
	/**
	 * Enregistre une Dependance
	 * @param Dependre $dependre
	 * @return bool Résultat de l'opération
	 */
	public function insert(Dependre $dependre) {
		return $this->db->prepare("INSERT INTO `dependre` (`ID_DOSSIER`, `CODE_ETAPE`) VALUES (?, ?);")
			->execute(array($dependre->getIdDossier(), $dependre->getCodeEtape()));
	}
	/**
	 * Supprime une Dependance
	 * @param Dependre $dependre
	 * @return bool Résultat de l'opération
	 */
	public function delete(Dependre $dependre) {
		return $this->db->prepare("DELETE FROM `dependre` WHERE `ID_DOSSIER` = ? AND `CODE_ETAPE` = ?;")
			->execute(array($dependre->getIdDossier(), $dependre->getCodeEtape()));
	}
}
