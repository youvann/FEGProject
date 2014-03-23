<?php
/**
 * @Project: FEG Project
 * @File: /Entities/TypeManager.php
 * @Purpose: Entité Type
 * @Author: Lionel Guissani
 */
class TypeManager {
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
	 * Retourne un type en fonction de son identifiant
	 * @param $id string Identifiant
	 * @return Type Type
	 */
	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `type` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Type($rs['ID'], $rs['LIBELLE']);
	}

	/**
	 * Retourne tous les types
	 * @return array Types
	 */
	public function findAll() {
		$types = array();
		$rs = $this->db->query("SELECT * FROM `type`;")->fetchAll();
		foreach ($rs as $type) {
			$types[] = new Type($type['ID'], $type['LIBELLE']);
		}
		return $types;
	}

	/**
	 * Enregistre un type
	 * @param Type $type Type
	 * @return bool Résultat de l'opération
	 */
	public function insert(Type $type) {
		return $this->db->prepare("INSERT INTO `type` (`ID`, `LIBELLE`) VALUES (?);")
						->execute(array($type->getNom()));
	}

	/**
	 * Met à jour un type
	 * @param Type $type Type
	 * @return bool Résultat de l'opération
	 */
	public function update(Type $type) {
		return $this->db->prepare("UPDATE `type` SET `LIBELLE` = ? WHERE `ID` = ?;")
						->execute(array(
							$type->getNom(),
							$type->getId()
		));
	}

	/**
	 * Supprime un type
	 * @param Type $type Type
	 * @return bool Résultat de l'opération
	 */
	public function delete(Type $type) {
		return $this->db->prepare("DELETE FROM `type` WHERE `ID` = ?;")
						->execute(array($type->getId()));
	}

}
