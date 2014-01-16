<?php
// CHECK
class FormationManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($codeEtape, $codeVet) {
		$rs = $this->db->prepare("SELECT * FROM `FORMATION` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array($codeEtape, $codeVet))->fetch();
		return new Formation($rs['MENTION'], $rs['ETAPE'], $rs['CODE_DIPLOME'], $rs['CODE_ETAPE'], $rs['CODE_VET'], $rs['RESPONSABLE'], $rs['VILLE'], $rs['FACULTE'], $rs['LANGUE_PDF']);
	}

	public function findAll() {
		$formations = array();
		$rs = $this->db->query("SELECT * FROM `FORMATION`;")->fetchAll();
		foreach ($rs as $formation) {
			$formations[] = new Formation($formation['MENTION'], $formation['ETAPE'], $formation['CODE_DIPLOME'], $formation['CODE_ETAPE'], $formation['CODE_VET'], $formation['RESPONSABLE'], $formation['VILLE'], $formation['FACULTE'], $formation['LANGUE_PDF']);
		}
		return $formations;
	}

	public function insert(Formation $formation) {
		return $this->db->prepare("insert into formation (`MENTION`, `ETAPE`, `CODE_DIPLOME`, `CODE_ETAPE`, `CODE_VET`, `RESPONSABLE`, `VILLE`, `FACULTE`, `LANGUE_PDF`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);")
						->execute(array(
							$formation->getMention(),
							$formation->getEtape(),
							$formation->getCodeDiplome(),
							$formation->getCodeEtape(),
							$formation->getCodeVet(),
							$formation->getResponsable(),
							$formation->getVille(),
							$formation->getFaculte(),
							$formation->getLanguePdf()
		));
	}

	public function update(Formation $formation) {
		return $this->db->prepare("UPDATE `FORMATION` SET `MENTION` = ?, `ETAPE` = ?, `CODE_DIPLOME` = ?, `RESPONSABLE` = ?, `VILLE` = ?, `FACULTE` = ?, `LANGUE_PDF` = ? WHERE `CODE_ETAPE` = ? and `CODE_VET` = ?;")
						->execute(array(
							$formation->getMention(),
							$formation->getEtape(),
							$formation->getCodeDiplome(),
							$formation->getResponsable(),
							$formation->getVille(),
							$formation->getFaculte(),
							$formation->getLanguePdf(),
							$formation->getCodeEtape(),
							$formation->getCodeVet()
		));
	}

	public function delete(Formation $formation) {
		return $this->db->prepare("DELETE FROM `FORMATION` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array(
							$formation->getCodeEtape(),
							$formation->getCodeVet()
		));
	}

}
