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
		$q = $this->db->prepare("SELECT * FROM `FORMATION` WHERE `CODE_FORMATION` = ?;");
		$q->execute(array($code));
		$rs = $q->fetch();
		return new Formation($rs['CODE_FORMATION'], $rs['MENTION'], $rs['MODALITES'], $rs['OUVERTE'], $rs['FACULTE'], $rs['LANGUE']);
	}

	public function findAll() {
		$formations = array();
		$rs = $this->db->query("SELECT * FROM `FORMATION`;")->fetchAll();
		foreach ($rs as $formation) {
			$formations[] = new Formation($formation['CODE_FORMATION'], $formation['MENTION'], $formation['MODALITES'], $formation['OUVERTE'], $formation['FACULTE'], $formation['LANGUE']);
		}
		return $formations;
	}

	public function insert(Formation $formation) {
		return $this->db->prepare("insert into formation (`CODE_FORMATION`, `MENTION`, `MODALITES`,`OUVERTE`, `FACULTE`, `LANGUE`) VALUES (?, ?, ?, ?, ?);")
						->execute(array(
							$formation->getCodeFormation(),
							$formation->getMention(),
							$formation->getModalites(),
							$formation->getOuverte(),
							$formation->getFaculte(),
							$formation->getLangue()
		));
	}

	public function update(Formation $formation) {
		return $this->db->prepare("UPDATE `FORMATION` SET `MENTION` = ?, `MODALITES` = ?, `OUVERTE` = ?, `FACULTE` = ?, `LANGUE` = ? WHERE `CODE_FORMATION` = ?;")
						->execute(array(
							$formation->getMention(),
							$formation->getModalites(),
							$formation->getOuverte(),
							$formation->getFaculte(),
							$formation->getLangue(),
							$formation->getCodeFormation()
		));
	}

	public function delete(Formation $formation) {
		return $this->db->prepare("DELETE FROM `FORMATION` WHERE `CODE_FORMATION` = ?;")
						->execute(array($formation->getCodeFormation()));
	}

}
