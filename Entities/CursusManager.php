<?php

class CursusManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findAllByDossier(Dossier $dossier) {

		$rs = $this->db->prepare("SELECT * FROM `CURSUS` WHERE `CURSUS`.`INE` = ? AND `CURSUS`.`CODE_FORMATION` = ?;")
						->execute(array($dossier->getIne(), $dossier->getCodeFormation()))->fetchAll();
		return new CursusEtudiant($rs['ID'], $rs['INE'], $rs['CODE_FORMATION'], $rs['ANNEE_DEBUT'], $rs['ANNEE_FIN'], $rs['ETABLISSEMENT'], $rs['VALIDE']);
	}

	public function insert(Cursus $cursus) {
		return $this->db->prepare("INSERT INTO `CURSUS` (`INE`, `CODE_FORMATION`, `ANNEE_DEBUT`, `ANNEE_FIN`, `CURSUS`, `ETABLISSEMENT`, `VALIDE`) VALUES (?, ?, ?, ?, ?, ?, ?);")
						->execute(array(
							$cursus->getIne(),
							$cursus->getCodeFormation(),
							$cursus->getAnneeDebut(),
							$cursus->getAnneeFin(),
							$cursus->getCursus(),
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
