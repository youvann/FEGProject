<?php

class FaculteManager {
	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `faculte` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Faculte($rs['ID'], $rs['NOM']);
	}

	public function findAll() {
		$facultes = array();
		$rs = $this->db->query("SELECT * FROM `faculte`;")->fetchAll();
		foreach ($rs as $faculte) {
			$facultes[] = new Faculte($faculte['ID'], $faculte['NOM']);
		}
		return $facultes;
	}

	public function insert(Faculte $faculte) {
		return $this->db->prepare("INSERT INTO `faculte` (`NOM`) VALUES (?);")
						->execute(array($faculte->getNom()));
	}

	public function update(Faculte $faculte) {
		return $this->db->prepare("UPDATE `faculte` SET `NOM` = ? WHERE `ID` = ?;")
						->execute(array(
							$faculte->getNom(),
							$faculte->getId()
		));
	}

	public function delete(Faculte $faculte) {
		return $this->db->prepare("DELETE FROM `faculte` WHERE `ID` = ?;")
						->execute(array($faculte->getId()));
	}
}
