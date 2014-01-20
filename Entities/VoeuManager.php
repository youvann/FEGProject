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
			$voeux[] = new Choix($voeu['ID'], $voeu['INFORMATION'], $voeu['TEXTE']);
		}
		return $voeux;
	}
	
	public function findAllByFormation($codeFormation) {
		$voeux = array();
		$rs = $this->db->prepare("SELECT * FROM `VOEU` WHERE `CODE` = ?;")
				->execute(array($codeFormation))->fetchAll();
		foreach ($rs as $voeu) {
			$voeux[] = new Choix($voeu['ID'], $voeu['INFORMATION'], $voeu['TEXTE']);
		}
		return $voeux;
	}

	public function insert(Voeu $voeu) {
		return $this->db->prepare("INSERT INTO `VOEU` (`CODE_ETAPE`, `CODE`, `ETAPE`, `RESPONSABLE`) VALUES ?, ?, ?, ?);")
						->execute(array($voeu->getCode(), $voeu->getCodeEtape(), $voeu->getEtape(), $voeu->getResponsable()));
	}

	public function update(Voeu $voeu) {
		return $this->db->prepare("UPDATE `VOEU` SET `CODE` = ?, `ETAPE` = ?, `RESPONSABLE` = ? WHERE `CODE_ETAPE` = ?;")
						->execute(array($voeu->getCodeEtape(), $voeu->getEtape(), $voeu->getResponsable(), $voeu->getCode()));
	}
	
	public function delete(Voeu $voeu) {
		return $this->db->prepare("DELETE FROM `VOEU` WHERE `CODE_ETAPE` = ?;")
						->execute(array($voeu->getCodeEtape()));
	}
}
