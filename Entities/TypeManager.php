<?php

class TypeManager {
private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `type` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Type($rs['ID'], $rs['LIBELLE']);
	}

	public function findAll() {
		$types = array();
		$rs = $this->db->query("SELECT * FROM `type`;")->fetchAll();
		foreach ($rs as $type) {
			$types[] = new Type($type['ID'], $type['LIBELLE']);
		}
		return $types;
	}

	public function insert(Type $type) {
		return $this->db->prepare("INSERT INTO `type` (`ID`, `LIBELLE`) VALUES (?);")
						->execute(array($type->getNom()));
	}

	public function update(Type $type) {
		return $this->db->prepare("UPDATE `type` SET `LIBELLE` = ? WHERE `ID` = ?;")
						->execute(array(
							$type->getNom(),
							$type->getId()
		));
	}

	public function delete(Type $type) {
		return $this->db->prepare("DELETE FROM `type` WHERE `ID` = ?;")
						->execute(array($type->getId()));
	}

}
