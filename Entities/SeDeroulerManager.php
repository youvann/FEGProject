<?php
/**
 * @Project: FEG Project
 * @File: /Entities/SeDeroulerManager.php
 * @Purpose: Entité SeDerouler
 * @Author: Lionel Guissani
 */
class SeDeroulerManager {
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
	 * Retourne les associations "une étape se déroule dans une ville"
	 * @return array Associations "une étape se déroule dans une ville"
	 */
	public function findAll() {
		$lesSeDerouler = array();
		$rs = $this->db->query("SELECT * FROM `se_derouler`;")->fetchAll();
		foreach ($rs as $unSeDerouler) {
			$lesSeDerouler[] = new SeDerouler($unSeDerouler['ID'], $unSeDerouler['CODE_ETAPE'], $unSeDerouler['RESPONSABLE'], $unSeDerouler['MAIL_RESPONSABLE']);
		}
		return $lesSeDerouler;
	}

	/**
	 * Retourne les associations "une étape se déroule dans une ville" en fonction du voeu passé en paramètre
	 * @param Voeu $voeu Voeu
	 * @return array Associations "une étape se déroule dans une ville" en fonction d'un voeu
	 */
	public function findAllByVoeu(Voeu $voeu) {
		$lesSeDerouler = array();
		$q = $this->db->prepare("SELECT * FROM `se_derouler` WHERE `CODE_ETAPE` = ?;");
		$q->execute(array($voeu->getCodeEtape()));
		$rs = $q->fetchAll();
		foreach ($rs as $unSeDerouler) {
			$lesSeDerouler[] = new SeDerouler($unSeDerouler['ID'], $unSeDerouler['CODE_ETAPE'], $unSeDerouler['RESPONSABLE'], $unSeDerouler['MAIL_RESPONSABLE']);
		}
		return $lesSeDerouler;
	}

	/**
	 * Enregistre une association "une étape se déroule dans une ville"
	 * @param SeDerouler $SeDerouler Association "une étape se déroule dans une ville"
	 * @return bool Résultat de l'opération
	 */
	public function insert(SeDerouler $SeDerouler) {
		return $this->db->prepare("INSERT INTO `se_derouler` (`ID`, `CODE_ETAPE`, `RESPONSABLE`, `MAIL_RESPONSABLE`) VALUES (?, ?, ?, ?);")
						->execute(array($SeDerouler->getId(), $SeDerouler->getCodeEtape(), $SeDerouler->getResponsable(), $SeDerouler->getMailResponsable()));
	}

	/**
	 * Supprime une association "une étape se déroule dans une ville"
	 * @param SeDerouler $SeDerouler Association "une étape se déroule dans une ville"
	 * @return bool Résultat de l'opération
	 */
	public function delete(SeDerouler $SeDerouler) {
		return $this->db->prepare("DELETE FROM `se_derouler` WHERE `ID`= ? AND `CODE_ETAPE` = ?;")
						->execute(array($SeDerouler->getId(), $SeDerouler->getCodeEtape()));
	}

}
