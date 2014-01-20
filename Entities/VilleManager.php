<?php

class VilleManager {
	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}
	
	public function find($codeVet) {
		$rs = $this->db->prepare("SELECT * FROM `VILLE` WHERE `CODE_VET` = ?;")
						->execute(array($codeVet))->fetch();
		return new Choix($rs['CODE_VET'], $rs['NOM']);
	}
	
	public function findAll() {
		$villes = array();
		$rs = $this->db->query("SELECT * FROM `VILLE`;")->fetchAll;
		foreach ($rs as $ville) {
			$villes[] = new Ville($ville['CODE_VET'], $ville['NOM']);
		}
		return $villes;
	}
	
	public function insert(Ville $ville) {
		return $this->db->prepare("INSERT INTO `VILLE` (`CODE_VET`, `NOM`) VALUES (?, ?);")
				->execute(array($ville->getCodeVet(), $ville->getNom()));
	}
	
	public function update(Ville $ville) {
		return $this->db->prepare("UPDATE `VILLE` SET `NOM`= ? WHERE `CODE_VET` = ?);")
				->execute(array($ville->getNom(), $ville->getCodeVet()));
	}
	
	public function delete(Ville $ville) {
		return $this->db->prepare("DELETE FROM `VILLE` WHERE `CODE_VET` = ?);")
				->execute(array($ville->getCodeVet()));
	}
}
