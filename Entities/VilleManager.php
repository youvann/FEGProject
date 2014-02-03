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
		$q = $this->db->prepare("SELECT * FROM `ville` WHERE `CODE_VET` = ?;");
		$q->execute(array($codeVet));
        $rs = $q->fetch();
		return new Ville($rs['CODE_VET'], $rs['NOM']);
	}
	
	public function findAll() {
		$villes = array();
		$rs = $this->db->query("SELECT * FROM `ville`;")->fetchAll();
		foreach ($rs as $ville) {
			$villes[] = new Ville($ville['CODE_VET'], $ville['NOM']);
		}
		return $villes;
	}
	
	public function insert(Ville $ville) {
		return $this->db->prepare("INSERT INTO `ville` (`CODE_VET`, `NOM`) VALUES (?, ?);")
				->execute(array($ville->getCodeVet(), $ville->getNom()));
	}
	
	public function update(Ville $ville) {
		return $this->db->prepare("UPDATE `ville` SET `NOM`= ? WHERE `CODE_VET` = ?);")
				->execute(array($ville->getNom(), $ville->getCodeVet()));
	}
	
	public function delete(Ville $ville) {
		return $this->db->prepare("DELETE FROM `ville` WHERE `CODE_VET` = ?);")
				->execute(array($ville->getCodeVet()));
	}
}
