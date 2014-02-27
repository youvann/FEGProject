<?php

class FormationManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($code) {
		$q = $this->db->prepare("SELECT * FROM `formation` WHERE `CODE_FORMATION` = ?;");
		$q->execute(array($code));
		$rs = $q->fetch();
		return new Formation($rs['CODE_FORMATION'], $rs['MENTION'], $rs['INFORMATIONS'], $rs['MODALITES'], $rs['FACULTE']);
	}

	public function findAll() {
		$formations = array();
		$rs = $this->db->query("SELECT * FROM `formation`;")->fetchAll();
		foreach ($rs as $formation) {
			$formations[] = new Formation($formation['CODE_FORMATION'], $formation['MENTION'], $formation['INFORMATIONS'], $formation['MODALITES'], $formation['FACULTE']);
		}
		return $formations;
	}

	public function insert(Formation $formation) {
		return $this->db->prepare("insert into formation (`CODE_FORMATION`, `MENTION`, `INFORMATIONS`, `MODALITES`, `FACULTE`) VALUES (?, ?, ?, ?, ?);")
						->execute(array(
							$formation->getCodeFormation(),
							$formation->getMention(),
							$formation->getInformations(),
							$formation->getModalites(),
							$formation->getFaculte()
		));
	}

	public function update(Formation $formation) {
		return $this->db->prepare("UPDATE `formation` SET `MENTION` = ?, `INFORMATIONS` = ?, `MODALITES` = ?, `FACULTE` = ? WHERE `CODE_FORMATION` = ?;")
						->execute(array(
							$formation->getMention(),
							$formation->getInformations(),
							$formation->getModalites(),
							$formation->getFaculte(),
							$formation->getCodeFormation()
		));
	}

	public function delete(Formation $formation) {
		return $this->db->prepare("DELETE FROM `formation` WHERE `CODE_FORMATION` = ?;")
						->execute(array($formation->getCodeFormation()));
	}

}
