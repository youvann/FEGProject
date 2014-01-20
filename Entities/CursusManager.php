<?php

class CursusManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findAllByEtudiant($ine, $codeFormation) {

		$rs = $this->db->prepare("SELECT * FROM `CURSUS` WHERE `CURSUS`.`INE` = ? AND `CURSUS`.`CODE_FORMATION` = ?;")
						->execute(array($ine, $codeFormation))->fetchAll();
		return new CursusEtudiant($rs['ID'], $rs['INE'], $rs['CODE_FORMATION'], $rs['ANNEE_DEBUT'], $rs['ANNEE_FIN'], $rs['ETABLISSEMENT'], $rs['VALIDE']);
	}

	public function insert(Cursus $cursus) {
		return $this->db->prepare("")
						->execute(array(
							$cursus->getId(),
							$cursus->getCodeFormation(),
							$cursus->getAnneeDebut(),
							$cursus->getAnneeFin(),
							$cursus->getEtablissement(),
							$cursus->getValide()
		));
	}

	public function delete(Cursus $cursus) {
		return $this->db->prepare("DELETE FROM `CURSUS` WHERE `CURSUS`.`INE` = ? AND `CURSUS`.`CODE_FORMATION` = ?;")
						->execute(array(
							$cursus->getId(),
							$cursus->getCodeFormation()
		));
	}

}
