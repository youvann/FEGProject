<?php

class TitulaireManager {
	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `TITULAIRE` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Titulaire($rs['ID'], $rs['LIBELLE']);
	}

	public function findAll() {
		$titulaires = array();
		$rs = $this->db->query("SELECT * FROM `TITULAIRE`;")->fetchAll();
		foreach ($rs as $titulaire) {
			$titulaires[] = new Titulaire($titulaire['ID'], $titulaire['LIBELLE']);
		}
		return $titulaires;
	}

	public function insert(Titulaire $titulaire) {
		return $this->db->prepare("INSERT INTO `TITULAIRE` (`LIBELLE`) VALUES (?);")
						->execute(array($titulaire->getLibelle()));
	}

	public function update(Titulaire $titulaire) {
		return $this->db->prepare("UPDATE `TITULAIRE` SET `LIBELLE` = ? WHERE `ID` = ?;")
						->execute(array(
							$titulaire->getLibelle(),
							$titulaire->getId()
		));
	}

	public function delete(Titulaire $titulaire) {
		return $this->db->prepare("DELETE FROM `TITULAIRE` WHERE `ID` = ?;")
						->execute(array($titulaire->getId()));
	}
}
