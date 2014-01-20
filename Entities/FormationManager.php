<?php
// CHECK
class FormationManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($code) {
		$q = $this->db->prepare("SELECT * FROM `FORMATION` WHERE `CODE` = ?;");
		$q->execute(array($code));
		$rs = $q->fetch();
		return new Formation($rs['CODE'], $rs['MENTION'], $rs['OUVERTE']);
	}

	public function findAll() {
		$formations = array();
		$rs = $this->db->query("SELECT * FROM `FORMATION`;")->fetchAll();
		foreach ($rs as $formation) {
			$formations[] = new Formation($formation['CODE'], $formation['MENTION'], $formation['OUVERTE']);
		}
		return $formations;
	}

	public function insert(Formation $formation) {
		return $this->db->prepare("insert into formation (`CODE`, `MENTION`, `OUVERTE`) VALUES (?, ?, ?);")
						->execute(array(
							$formation->getCode(),
							$formation->getMention(),
							$formation->getOuverte()
		));
	}

	public function update(Formation $formation) {
		return $this->db->prepare("UPDATE `FORMATION` SET `CODE` = ?, `MENTION` = ?, `OUVERTE` = ? WHERE `CODE` = ?;")
						->execute(array(
							$formation->getMention(),
							$formation->getOuverte(),
							$formation->getCode()
		));
	}

	public function delete(Formation $formation) {
		return $this->db->prepare("DELETE FROM `FORMATION` WHERE `CODE` = ?;")
						->execute(array($formation->getCode()));
	}

}
