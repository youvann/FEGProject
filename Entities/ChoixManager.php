<?php
/**
 * @Project: FEG Project
 * @File: /Entities/ChoixManager.php
 * @Purpose: Entité Choix
 * @Author: Lionel Guissani
 */
class ChoixManager {
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
	 * Récupère un Choix en fonction de son identifiant
	 * @param $id string Identifiant du Choix
	 * @return Choix Choix
	 */
	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `choix` WHERE `ID` = ?;");
        $q->execute(array($id))->fetch();
        $rs = $q->fetchAll();
		return new Choix($rs['ID'], $rs['INFORMATION'], $rs['TEXTE']);
	}
	/**
	 * Récupère tous les choix
	 * @return Choix Tous les Choix
	 */
	public function findAll() {
		$lesChoix = array();
		$rs = $this->db->query("SELECT * FROM `choix`;")->fetchAll();
		foreach ($rs as $unChoix) {
			$lesChoix[] = new Choix($unChoix['ID'], $unChoix['INFORMATION'], $unChoix['TEXTE']);
		}
		return $lesChoix;
	}

	/**
	 * Récupère tous les choix en fonction d'une Information
	 * @param Information $information Information
	 * @return array Tous les choix en fonction de l'Information
	 */
	public function findAllByInformation(Information $information) {
		$lesChoix = array();
		$q = $this->db->prepare("SELECT * FROM `choix` WHERE `INFORMATION` = ?;");
		$q->execute(array($information->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $unChoix) {
			$lesChoix[] = new Choix($unChoix['ID'], $unChoix['INFORMATION'], $unChoix['TEXTE']);
		}
		return $lesChoix;
	}

	/**
	 * Enregistre un Choix
	 * @param Choix $choix
	 * @return bool Résultat de l'opération
	 */
	public function insert(Choix $choix) {
		return $this->db->prepare("INSERT INTO `choix` (`INFORMATION`, `TEXTE`) VALUES (?, ?);")
						->execute(array($choix->getInformation(), $choix->getTexte()));
	}

	/**
	 * Met à jour un Choix
	 * @param Choix $choix
	 * @return bool Résultat de l'opération
	 */
	public function update(Choix $choix) {
		return $this->db->prepare("UPDATE `choix` SET `INFORMATION` = ?, `TEXTE` = ? WHERE `ID` = ?;")
						->execute(array($choix->getInformation(), $choix->getTexte(), $choix->getId()));
	}

	/**
	 * Supprime un Choix
	 * @param Choix $choix
	 * @return bool Résultat de l'opération
	 */
	public function delete(Choix $choix) {
		return $this->db->prepare("DELETE FROM `choix` WHERE `ID` = ?;")
						->execute(array($choix->getId()));
	}
}
