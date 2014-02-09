<?php

class DependreManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findFilles(Voeu $voeu) {
		$dependances = array();
		$q = $this->db->prepare("SELECT * FROM `dependre` WHERE `CODE_FORMATION_MERE` = ? AND `CODE_ETAPE_MERE` = ?;");
		$q->execute(array($voeu->getCodeFormation(), $voeu->getCodeEtape()));
		$rs = $q->fetchAll();

		foreach ($rs as $dependance) {
			$dependances[] = new Dependre($dependance['CODE_FORMATION_MERE'], $dependance['CODE_ETAPE_MERE'], $dependance['CODE_FORMATION_FILLE']);
		}
		return $dependances;
	}

	public function findMeres(Formation $formation) {
		$dependances = array();
		$q = $this->db->prepare("SELECT * FROM `dependre` WHERE `CODE_FORMATION_FILLE` = ?;");
		$q->execute(array($formation->getCodeFormation()));
		$rs = $q->fetchAll();

		foreach ($rs as $dependance) {
			$dependances[] = new Dependre($dependance['CODE_FORMATION_MERE'], $dependance['CODE_ETAPE_MERE'], $dependance['CODE_FORMATION_FILLE']);
		}
		return $dependances;
	}

	public function insert(Dependre $dependre) {
		return $this->db->prepare("INSERT INTO `dependre` (`CODE_FORMATION_MERE`, `CODE_ETAPE_MERE`, `CODE_FORMATION_FILLE`) VALUES (?, ?, ?);")
			->execute(array($dependre->getCodeFormationMere(), $dependre->getCodeEtapeMere(), $dependre->getCodeFormationFille()));
	}

	public function delete(Dependre $dependre) {
		return $this->db->prepare("DELETE FROM `dependre` WHERE `CODE_FORMATION_MERE` = ? AND `CODE_ETAPE_MERE` = ? AND `CODE_FORMATION_FILLE` = ?;")
			->execute(array($dependre->getCodeFormationMere(), $dependre->getCodeEtapeMere(), $dependre->getCodeFormationFille()));
	}

	public function deleteAllMeres(Formation $formation) {
		return $this->db->prepare("DELETE FROM `dependre` WHERE `CODE_FORMATION_FILLE` = ?;")->execute(array($formation->getCodeFormation()));
	}
}
