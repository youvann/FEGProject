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
		$q = $this->db->prepare("SELECT * FROM `voeu` WHERE `CODE_ETAPE` = ?;");
		$q->execute(array($codeEtape));
		$rs = $q->fetch();
		return new Voeu($rs['CODE_ETAPE'], $rs['CODE_FORMATION'], $rs['ETAPE'], $rs['DOSSIER_PDF']);
	}

	public function findAll() {
		$voeux = array();
		$rs = $this->db->query("SELECT * FROM `voeu`;")->fetchAll();
		foreach ($rs as $voeu) {
			$voeux[] = new Voeu($voeu['CODE_ETAPE'], $voeu['CODE_FORMATION'], $voeu['ETAPE'], $voeu['DOSSIER_PDF']);
		}
		return $voeux;
	}
	
	public function findAllByFormation(Formation $formation) {
		$voeux = array();
		$q = $this->db->prepare("SELECT * FROM `voeu` WHERE `CODE_FORMATION` = ?;");
		$q->execute(array($formation->getCodeFormation()));
		$rs = $q->fetchAll();
		foreach ($rs as $voeu) {
			$voeux[] = new Voeu($voeu['CODE_ETAPE'], $voeu['CODE_FORMATION'], $voeu['ETAPE'], $voeu['DOSSIER_PDF']);
		}
		return $voeux;
	}

	public function insert(Voeu $voeu) {
		return $this->db->prepare("INSERT INTO `voeu` (`CODE_ETAPE`, `CODE_FORMATION`, `ETAPE`, `DOSSIER_PDF`) VALUES (?, ?, ?, NULL);")
						->execute(array($voeu->getCodeEtape(), $voeu->getCodeFormation(), $voeu->getEtape(), ));
	}

	public function update(Voeu $voeu) {
		return $this->db->prepare("UPDATE `voeu` SET `CODE_FORMATION` = ?, `ETAPE` = ?, `DOSSIER_PDF` = ? WHERE `CODE_ETAPE` = ?;")
						->execute(array($voeu->getCodeFormation(), $voeu->getEtape(), $voeu->getDossierPdf(), $voeu->getCodeEtape()));
	}
	
	public function delete(Voeu $voeu) {
		return $this->db->prepare("DELETE FROM `voeu` WHERE `CODE_ETAPE` = ?;")
						->execute(array($voeu->getCodeEtape()));
	}
	
	public function getVilles(Voeu $voeu) {
		$villes = array();
		$q = $this->db->prepare("SELECT * FROM `VILLE` INNER JOIN `SE_DEROULER` ON `VILLE`.`ID` = `SE_DEROULER`.`ID` WHERE `SE_DEROULER`.`CODE_ETAPE` = ?;");
		$q->execute(array($voeu->getCodeEtape()));
		$rs = $q->fetchAll();
		foreach ($rs as $ville) {
			$villes[] = new Ville($ville['ID'], $ville['NOM']);
		}
		return $villes;
	}
}
