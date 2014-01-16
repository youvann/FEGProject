<?php

class CursusEtudiantManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($numIne, $codeEtape, $codeVet) {
		$rs = $this->db->prepare("SELECT * FROM `CURSUS_ETUDIANT` WHERE `NUM_INE` = ? AND `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array($numIne, $codeEtape, $codeVet))->fetch();
		return new CursusEtudiant($rs['NUM_INE'], $rs['CURSUS_SUIVIT'], $rs['ANNEE'], $rs['ETABLISSEMENT'], $rs['VALIDE'], $rs['CODE_ETAPE'], $rs['CODE_VET']);
	}

	public function findAll() {
		$cursusEtudiants = array();
		$rs = $this->db->query("SELECT * FROM `CURSUS_ETUDIANT`;")->fetchAll();
		foreach ($rs as $cursusEtudiant) {
			$cursusEtudiants[] = new CursusEtudiant($cursusEtudiant['NUM_INE'], $cursusEtudiant['CURSUS_SUIVIT'], $cursusEtudiant['ANNEE'], $cursusEtudiant['ETABLISSEMENT'], $cursusEtudiant['VALIDE'], $cursusEtudiant['CODE_ETAPE'], $cursusEtudiant['CODE_VET']);
		}
		return $cursusEtudiants;
	}

	public function insert(CursusEtudiant $cursusEtudiant) {
		return $this->db->prepare("")
						->execute(array(
							$cursusEtudiant->getNumIne(),
							$cursusEtudiant->getCursusSuivit(),
							$cursusEtudiant->getAnnee(),
							$cursusEtudiant->getEtablissement(),
							$cursusEtudiant->getValide(),
							$cursusEtudiant->getCodeEtape(),
							$cursusEtudiant->getCodeVet()));
	}

	public function delete(CursusEtudiant $cursusEtudiant) {
		return $this->db->prepare("")
						->execute(array(
							$cursusEtudiant->getNumIne(),
							$cursusEtudiant->getCodeEtape(),
							$cursusEtudiant->getCodeVet()
		));
	}

}
