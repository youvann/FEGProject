<?php

class VoeuManager {
	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($codeEtape) {
		$rs = $this->db->prepare("SELECT * FROM `VOEU` WHERE `CODE_ETAPE` = ?;")
						->execute(array($codeEtape))->fetch();
		return new Choix($rs['CODE_ETAPE'], $rs['CODE'], $rs['ETAPE'], $rs['RESPONSABLE']);
	}

	public function findAll() {
		$voeux = array();
		$rs = $this->db->query("SELECT * FROM `VOEU`;")->fetchAll();
		foreach ($rs as $voeu) {
			$voeux[] = Voeu($voeu['CODE_ETAPE'], $voeu['CODE_FORMATION'], $voeu['ETAPE'], $voeu['RESPONSABLE']);
		}
		return $voeux;
	}
	
	public function findAllByFormation(Formation $formation) {
		$voeux = array();
		$q = $this->db->prepare("SELECT * FROM `VOEU` WHERE `CODE_FORMATION` = ?;");
		$q->execute(array($formation->getCodeFormation()));
		$rs = $q->fetchAll();
		foreach ($rs as $voeu) {
			$voeux[] = new Voeu($voeu['CODE_ETAPE'], $voeu['CODE_FORMATION'], $voeu['ETAPE'], $voeu['RESPONSABLE']);
		}
		return $voeux;
	}

	public function insert(Voeu $voeu) {
		return $this->db->prepare("INSERT INTO `VOEU` (`CODE_ETAPE`, `CODE_FORMATION`, `ETAPE`, `RESPONSABLE`) VALUES (?, ?, ?, ?);")
						->execute(array($voeu->getCodeEtape(), $voeu->getCodeFormation(), $voeu->getEtape(), $voeu->getResponsable()));
	}

	public function update(Voeu $voeu) {
		return $this->db->prepare("UPDATE `VOEU` SET `CODE_FORMATION` = ?, `ETAPE` = ?, `RESPONSABLE` = ? WHERE `CODE_ETAPE` = ?;")
						->execute(array($voeu->getCodeFormation(), $voeu->getEtape(), $voeu->getResponsable(), $voeu->getCodeEtape()));
	}
	
	public function delete(Voeu $voeu) {
		return $this->db->prepare("DELETE FROM `VOEU` WHERE `CODE_ETAPE` = ?;")
						->execute(array($voeu->getCodeEtape()));
	}
	
	public function getVilles(Voeu $voeu) {
		$villes = array();
		$q = $this->db->prepare("SELECT * FROM `VILLE` INNER JOIN `SE_DEROULER` ON `VILLE`.`CODE_VET` = `SE_DEROULER`.`CODE_VET` WHERE `SE_DEROULER`.`CODE_ETAPE` = ?;");
		$q->execute(array($voeu->getCodeEtape()));
		$rs = $q->fetchAll();
		foreach ($rs as $ville) {
			$villes[] = new Ville($ville['CODE_VET'], $ville['NOM']);
		}
		return $villes;
		
	}
}
