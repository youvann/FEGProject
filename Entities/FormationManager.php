<?php
/**
 * @Project: FEG Project
 * @File: /Entities/FormationManager.php
 * @Purpose: Entité Formation
 * @Author: Lionel Guissani
 */
class FormationManager {
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
	 * Retourne une formation en fonction de son code
	 * @param $code string Code de la formation
	 * @return Formation Formation
	 */
	public function find($code) {
		$q = $this->db->prepare("SELECT * FROM `formation` WHERE `CODE_FORMATION` = ?;");
		$q->execute(array($code));
		$rs = $q->fetch();
		return new Formation($rs['CODE_FORMATION'], $rs['MENTION'], $rs['FACULTE']);
	}

	/**
	 * Retourne toutes les formations
	 * @return array Toutes les formation
	 */
	public function findAll() {
		$formations = array();
		$rs = $this->db->query("SELECT * FROM `formation`;")->fetchAll();
		foreach ($rs as $formation) {
			$formations[] = new Formation($formation['CODE_FORMATION'], $formation['MENTION'], $formation['FACULTE']);
		}
		return $formations;
	}

	/**
	 * Enregistre une formation
	 * @param Formation $formation Formation
	 * @return bool Résultat de l'opération
	 */
	public function insert(Formation $formation) {
		return $this->db->prepare("insert into formation (`CODE_FORMATION`, `MENTION`, `FACULTE`) VALUES (?, ?, ?);")
						->execute(array(
							$formation->getCodeFormation(),
							$formation->getMention(),
							$formation->getFaculte()
		));
	}

	/**
	 * Met à jour une formation
	 * @param Formation $formation Formation
	 * @return bool Résultat de l'opération
	 */
	public function update(Formation $formation) {
		return $this->db->prepare("UPDATE `formation` SET `MENTION` = ?, `FACULTE` = ? WHERE `CODE_FORMATION` = ?;")
						->execute(array(
							$formation->getMention(),
							$formation->getFaculte(),
							$formation->getCodeFormation()
		));
	}

	/**
	 * Supprime une formation
	 * @param Formation $formation Formation
	 * @return bool Résultat de l'opération
	 */
	public function delete(Formation $formation) {
		return $this->db->prepare("DELETE FROM `formation` WHERE `CODE_FORMATION` = ?;")
						->execute(array($formation->getCodeFormation()));
	}

}
