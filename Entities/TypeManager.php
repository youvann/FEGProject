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
		$rs = $this->db->prepare("SELECT * FROM `TYPE` WHERE `ID` = ?;")
						->execute(array($id))->fetch();
		return new Type($rs['ID'], $rs['NOM']);
	}

	public function findAll() {
		$types = array();
		$rs = $this->db->query("SELECT * FROM `TYPE`;")->fetchAll();
		foreach ($rs as $type) {
			$types[] = new Type($type['ID'], $type['NOM']);
		}
		return $types;
	}

	public function insert(Type $type) {
		return $this->db->prepare("INSERT INTO `TYPE` (`NOM`) VALUES (?);")
						->execute(array($type->getNom()));
	}

	public function update(Type $type) {
		return $this->db->prepare("UPDATE `TYPE` SET `NOM` = ? WHERE `ID` = ?;")
						->execute(array(
							$type->getNom(),
							$type->getId()
		));
	}

	public function delete(Type $type) {
		return $this->db->prepare("DELETE FROM `TYPE` WHERE `ID` = ?;")
						->execute(array($type->getId()));
	}

}
