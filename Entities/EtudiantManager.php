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
		$q = $this->db->prepare("SELECT * FROM `etudiant` WHERE `INE` = ?;");
		$q->execute(array($ine));
		$rs = $q->fetch();
		return new Etudiant($rs['INE'], $rs['NOMBRE_DEPOTS']);
	}

	public function findAll() {
		$etudiants = array();
		$rs = $this->db->query("SELECT * FROM `etudiant`;")->fetchAll();
		foreach ($rs as $etudiant) {
			$etudiants[] = new Etudiant($etudiant['INE'], $etudiant['NOMBRE_DEPOTS']);
		}
		return $etudiants;
	}
	
	public function insert(Etudiant $etudiant) {
		return $this->db->prepare("INSERT INTO `etudiant` (`INE`, `NOMBRE_DEPOTS`) VALUES (?, ?);")
						->execute(array(
							$etudiant->getIne(),
							$etudiant->getNombreDepots()
		));
	}
	
	public function update(Etudiant $etudiant) {
		return $this->db->prepare("UPDATE `etudiant` SET `NOMBRE_DEPOTS` = ? WHERE `INE` = ?;")
						->execute(array(
							$etudiant->getNombreDepots(),
							$etudiant->getIne()
		));
	}
	
	public function delete(Etudiant $etudiant) {
		return $this->db->prepare("DELETE FROM `etudiant` WHERE `INE` = ?);")
						->execute(array($etudiant->getIne()));
	}
	
	public function ifExists(Etudiant $etudiant) {
		$q = $this->db->prepare("SELECT if(count(*) = 1, TRUE, FALSE) as ifExists FROM `etudiant` WHERE `INE` = ?;");
		$q->execute(array($etudiant->getIne()));
		$rs = $q->fetch();
		return (bool)$rs['ifExists'];
	}
}