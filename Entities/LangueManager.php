<?php

class LangueManager {
	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `LANGUE` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Faculte($rs['ID'], $rs['NOM']);
	}

	public function findAll() {
		$langues = array();
		$rs = $this->db->query("SELECT * FROM `LANGUE`;")->fetchAll();
		foreach ($rs as $langue) {
			$langues[] = new Faculte($langue['ID'], $langue['NOM']);
		}
		return $langues;
	}

	public function insert(Langue $langue) {
		return $this->db->prepare("INSERT INTO `LANGUE` (`ID`, `NOM`) VALUES (?, ?);")
						->execute(array($langue->getId(), $langue->getNom()));
	}

	public function update(Langue $langue) {
		return $this->db->prepare("UPDATE `LANGUE` SET `NOM` = ? WHERE `ID` = ?;")
						->execute(array(
							$langue->getNom(),
							$langue->getId()
		));
	}

	public function delete(Langue $langue) {
		return $this->db->prepare("DELETE FROM `LANGUE` WHERE `ID` = ?;")
						->execute(array($langue->getId()));
	}
}