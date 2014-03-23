<?php
/**
 * @Project: FEG Project
 * @File: /Entities/VilleManager.php
 * @Purpose: Entité Ville
 * @Author: Lionel Guissani
 */
class VilleManager {
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
	 * Retourne une ville en fonction de son identifiant
	 * @param $id string Identifiant
	 * @return Ville Ville
	 */
	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `ville` WHERE `ID` = ?;");
		$q->execute(array($id));
        $rs = $q->fetch();
		return new Ville($rs['ID'], $rs['NOM']);
	}

	/**
	 * Retourne toutes les villes
	 * @return array Villes
	 */
	public function findAll() {
		$villes = array();
		$rs = $this->db->query("SELECT * FROM `ville`;")->fetchAll();
		foreach ($rs as $ville) {
			$villes[] = new Ville($ville['ID'], $ville['NOM']);
		}
		return $villes;
	}

	/**
	 * Retourne toutes les villes en fonction d'un dossier pdf
	 * @param $dossierPdf DossierPdf Dossier pdf
	 * @return array Villes
	 */
	public function findAllByDossierPdf(DossierPdf $dossierPdf) {
		$villes = array();
		$q = $this->db->prepare("SELECT DISTINCT `ville`.`ID`, `ville`.`NOM`
			FROM `ville`
			INNER JOIN `se_derouler` ON (`ville`.`ID` = `se_derouler`.`ID`)
			INNER JOIN `voeu` ON (`se_derouler`.`CODE_ETAPE` = `voeu`.`CODE_ETAPE`)
			INNER JOIN `dossier_pdf` ON (`voeu`.`DOSSIER_PDF` = `dossier_pdf`.`ID`)
			WHERE `dossier_pdf`.`ID` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $ville) {
			$villes[] = new Ville($ville['ID'], $ville['NOM']);
		}
		return $villes;
	}

	/**
	 * Enregistre une ville
	 * @param Ville $ville Ville
	 * @return bool Résultat de l'opération
	 */
	public function insert(Ville $ville) {
		return $this->db->prepare("INSERT INTO `ville` (`NOM`) VALUES (?);")
				->execute(array($ville->getNom()));
	}
	/**
	 * Met à jour une ville
	 * @param Ville $ville Ville
	 * @return bool Résultat de l'opération
	 */
	public function update(Ville $ville) {
		return $this->db->prepare("UPDATE `ville` SET `NOM`= ? WHERE `ID` = ?);")
				->execute(array($ville->getNom(), $ville->getId()));
	}
	/**
	 * Suppirme une ville
	 * @param Ville $ville Ville
	 * @return bool Résultat de l'opération
	 */
	public function delete(Ville $ville) {
		return $this->db->prepare("DELETE FROM `ville` WHERE `ID` = ?);")
				->execute(array($ville->getId()));
	}
}
