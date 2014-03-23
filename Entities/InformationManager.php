<?php
/**
 * @Project: FEG Project
 * @File: /Entities/InformationManager.php
 * @Purpose: Entité Information
 * @Author: Lionel Guissani
 */
class InformationManager {

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
	 * Retourne une information en fonction de son identifiant
	 * @param $id string Identifiant
	 * @return Information
	 */
	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `information` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Information($rs['ID'], $rs['TYPE'], $rs['DOSSIER_PDF'], $rs['LIBELLE'], $rs['EXPLICATIONS'], $rs['ORDRE']);
	}

	/**
	 * Retourne toutes les information en fonction du dossier pdf passé en paramètre
	 * @param $dossierPdf DossierPdf Dossier pdf
	 * @return array
	 */
	public function findAllByDossierPdf(DossierPdf $dossierPdf) {
		$informations = array();
		$q = $this->db->prepare("SELECT * FROM `information` WHERE `DOSSIER_PDF` = ? ORDER BY `ORDRE`;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $information) {
			$informations[] = new Information($information['ID'], $information['TYPE'], $information['DOSSIER_PDF'], $information['LIBELLE'], $information['EXPLICATIONS'], $information['ORDRE']);
		}
		return $informations;
	}

	/**
	 * Enregistre une information
	 * @param Information $information Information spécifique
	 * @return bool Résultat de l'opération
	 */
	public function insert(Information $information) {
		$q = $this->db->prepare("SELECT (SELECT ifnull(max(`id`),'i00000')  FROM `information`) as id, (SELECT ifnull(max(`ordre`),'0') FROM `information` WHERE `information`.`dossier_pdf` = ?) as ordre;");
		$q->execute(array($information->getDossierPdf()));
		$rs = $q->fetch();
		$id = $rs['id'];
		$ordre = $rs['ordre'];

		return $this->db->prepare("INSERT INTO `information` (`ID`, `TYPE`, `DOSSIER_PDF`, `LIBELLE`, `EXPLICATIONS`, `ORDRE`) VALUES (?, ?, ?, ?, ?, ?);")
						->execute(array(
							++$id,
							$information->getType(),
							$information->getDossierPdf(),
							$information->getLibelle(),
							$information->getExplications(),
							++$ordre
		));
	}

	/**
	 * Met à jour une information
	 * @param Information $information Information spécifique
	 * @return bool Résultat de l'opération
	 */
	public function update(Information $information) {
		return $this->db->prepare("UPDATE `information` SET `TYPE` = ?, `DOSSIER_PDF` = ?, `LIBELLE` = ?, `EXPLICATIONS` = ?, `ORDRE` = ? WHERE `ID` = ?;")
						->execute(array(
							$information->getType(),
							$information->getDossierPdf(),
							$information->getLibelle(),
							$information->getExplications(),
							$information->getOrdre(),
							$information->getId(),
		));
	}

	/**
	 * Supprime une information
	 * @param Information $information Information spécifique
	 * @return bool Résultat de l'opération
	 */
	public function delete(Information $information) {
		return $this->db->prepare("DELETE FROM `information` WHERE `ID` = ?;")
						->execute(array($information->getId()));
	}

	/**
	 * Retourne le plus grand identifiant
	 * @return string Plus grand identifiant
	 */
	public function maxId() {
		$rs = $this->db->query("SELECT MAX(`ID`) as ID FROM `information`;")->fetch();
		return $rs['ID'];
	}

	/**
	 * Retourne la structure des informations spécifiques demandées dans un dossier pdf
	 * @param DossierPdf $dossierPdf Dossier pdf
	 * @return array
	 */
	public function getResultset(DossierPdf $dossierPdf) {
		$q = $this->db->prepare("SELECT `information`.`ID` as idInfo,
		CONCAT(`information`.`LIBELLE`, IF(`information`.`EXPLICATIONS` != '', CONCAT(' <i>(', `information`.`EXPLICATIONS`,')</i>'), '')) as libelleInfo,
		`type`.`ID` as typeInfo,
		`choix`.`TEXTE` as libellesInfo
			FROM `information` 
			INNER JOIN `type` ON (`information`.`type` = `type`.`id`)
			LEFT JOIN `choix` ON (`information`.`id` = `choix`.`information`)
			WHERE `information`.`dossier_pdf` = ?
			ORDER BY `information`.`ordre`;");
		$q->execute(array($dossierPdf->getId()));
		return $q->fetchAll();
	}
}
