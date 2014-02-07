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
		return new Ville($rs['ID'], $rs['NOM']);
	}
	
	public function findAll() {
		$villes = array();
		$rs = $this->db->query("SELECT * FROM `ville`;")->fetchAll();
		foreach ($rs as $ville) {
			$villes[] = new Ville($ville['ID'], $ville['NOM']);
		}
		return $villes;
	}
	
	public function insert(Ville $ville) {
		return $this->db->prepare("INSERT INTO `ville` (`NOM`) VALUES (?);")
				->execute(array($ville->getNom()));
	}
	
	public function update(Ville $ville) {
		return $this->db->prepare("UPDATE `ville` SET `NOM`= ? WHERE `ID` = ?);")
				->execute(array($ville->getNom(), $ville->getId()));
	}
	
	public function delete(Ville $ville) {
		return $this->db->prepare("DELETE FROM `ville` WHERE `ID` = ?);")
				->execute(array($ville->getId()));
	}
}
