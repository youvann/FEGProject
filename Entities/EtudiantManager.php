<?php

class EtudiantManager {
	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}
	
	public function find($ine) {
		$rs = $this->db->prepare("SELECT * FROM `ETUDIANT` WHERE `INE` = ?;")
						->execute(array($ine))->fetch();
		return new Etudiant($rs['INE'], $rs['NOMBRE_DEPOTS']);
	}

	public function findAll() {
		$etudiants = array();
		$rs = $this->db->query("SELECT * FROM `ETUDIANT`;")->fetchAll();
		foreach ($rs as $etudiant) {
			$etudiants[] = new Etudiant($etudiant['INE'], $etudiant['NOMBRE_DEPOTS']);
		}
		return $etudiants;
	}
	
	public function insert(Etudiant $etudiant) {
		return $this->db->prepare("INSERT INTO `ETUDIANT` (`INE`, `NOMBRE_DEPOT`) VALUES (?, ?);")
						->execute(array(
							$etudiant->getIne(),
							$etudiant->getNombreDepots()
		));
	}
	
	public function update(Etudiant $etudiant) {
		return $this->db->prepare("UPDATE `ETUDIANT` SET `NOMBRE_DEPOT` = ? WHERE `ID` = ?);")
						->execute(array(
							$etudiant->getNombreDepots(),
							$etudiant->getIne()
		));
	}
	
	public function delete(Etudiant $etudiant) {
		return $this->db->prepare("DELETE FROM `ETUDIANT` WHERE `ID` = ?);")
						->execute(array($etudiant->getIne()));
	}
}