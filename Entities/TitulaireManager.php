<?php
/**
 * @Project: FEG Project
 * @File: /Entities/TitulaireManager.php
 * @Purpose: Entité Titulaire
 * @Author: Lionel Guissani
 */
class TitulaireManager {
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
	 * Retourne un titulaire en fonction de son identifiant
	 * @param $id string Identifiant
	 * @return Titulaire Titulaire
	 */
	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `titulaire` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Titulaire($rs['ID'], $rs['LIBELLE']);
	}

	/**
	 * Retourne tous les titulaires
	 * @return array Tous les Titulaires
	 */
	public function findAll() {
		$titulaires = array();
		$rs = $this->db->query("SELECT * FROM `titulaire`;")->fetchAll();
		foreach ($rs as $titulaire) {
			$titulaires[] = new Titulaire($titulaire['ID'], $titulaire['LIBELLE']);
		}
		return $titulaires;
	}

	/**
	 * Enregistre un titulaire
	 * @param Titulaire $titulaire Titulaire
	 * @return bool Résultat de l'opération
	 */
	public function insert(Titulaire $titulaire) {
		return $this->db->prepare("INSERT INTO `titulaire` (`LIBELLE`) VALUES (?);")
						->execute(array($titulaire->getLibelle()));
	}

	/**
	 * Met à jour un titulaire
	 * @param Titulaire $titulaire Titulaire
	 * @return bool Résultat de l'opération
	 */
	public function update(Titulaire $titulaire) {
		return $this->db->prepare("UPDATE `titulaire` SET `LIBELLE` = ? WHERE `ID` = ?;")
						->execute(array(
							$titulaire->getLibelle(),
							$titulaire->getId()
		));
	}

	/**
	 * Supprime un titulaire
	 * @param Titulaire $titulaire Titulaire
	 * @return bool Résultat de l'opération
	 */
	public function delete(Titulaire $titulaire) {
		return $this->db->prepare("DELETE FROM `titulaire` WHERE `ID` = ?;")
						->execute(array($titulaire->getId()));
	}
}
