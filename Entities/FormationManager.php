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
		return new Formation($rs['CODE_FORMATION'], $rs['MENTION'], $rs['MODALITES'], $rs['OUVERTE'], $rs['FACULTE']);
	}

	public function findAll() {
		$formations = array();
		$rs = $this->db->query("SELECT * FROM `FORMATION`;")->fetchAll();
		foreach ($rs as $formation) {
			$formations[] = new Formation($formation['CODE_FORMATION'], $formation['MENTION'], $formation['MODALITES'], $formation['OUVERTE'], $formation['FACULTE']);
		}
		return $formations;
	}

	public function getLinks() {
		return $this->db->query("SELECT CONCAT('<a href=\"http://miage-aix-marseille.fr/?uc=formulaire&action=choixFormation&formationchoisie=', `formation`.`CODE_FORMATION`, '\">', `formation`.`MENTION`, '</a>') as lien FROM `formation`;")->fetchAll();
	}

	public function insert(Formation $formation) {
		return $this->db->prepare("insert into formation (`CODE_FORMATION`, `MENTION`, `MODALITES`,`OUVERTE`, `FACULTE`) VALUES (?, ?, ?, ?, ?);")
						->execute(array(
							$formation->getCodeFormation(),
							$formation->getMention(),
							$formation->getModalites(),
							$formation->getOuverte(),
							$formation->getFaculte()
		));
	}

	public function update(Formation $formation) {
		return $this->db->prepare("UPDATE `FORMATION` SET `MENTION` = ?, `MODALITES` = ?, `OUVERTE` = ?, `FACULTE` = ? WHERE `CODE_FORMATION` = ?;")
						->execute(array(
							$formation->getMention(),
							$formation->getModalites(),
							$formation->getOuverte(),
							$formation->getFaculte(),
							$formation->getCodeFormation()
		));
	}

	public function delete(Formation $formation) {
		return $this->db->prepare("DELETE FROM `FORMATION` WHERE `CODE_FORMATION` = ?;")
						->execute(array($formation->getCodeFormation()));
	}

}
