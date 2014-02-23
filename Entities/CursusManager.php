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
        $lesCursus = array();
		$q = $this->db->prepare("SELECT * FROM `cursus` WHERE `cursus`.`INE` = ? AND `cursus`.`CODE_FORMATION` = ?;");
        $q->execute(array($dossier->getIne(), $dossier->getCodeFormation()));
        $rs = $q->fetchAll();

        foreach($rs as $cursus){
            $lesCursus[] = new Cursus($cursus['ID'], $cursus['ID_ETUDIANT'], $cursus['CODE_FORMATION'], $cursus['ANNEE_DEBUT'], $cursus['ANNEE_FIN'], $cursus['CURSUS'], $cursus['ETABLISSEMENT'], $cursus['NOTE']);
        }
        return $lesCursus;
	}

	public function insert(Cursus $cursus) {
		return $this->db->prepare("INSERT INTO `cursus` (`ID_ETUDIANT`, `CODE_FORMATION`, `ANNEE_DEBUT`, `ANNEE_FIN`, `CURSUS`, `ETABLISSEMENT`, `NOTE`) VALUES (?, ?, ?, ?, ?, ?, ?);")
						->execute(array(
							$cursus->getIdEtudiant(),
							$cursus->getCodeFormation(),
							$cursus->getAnneeDebut(),
							$cursus->getAnneeFin(),
							$cursus->getCursus(),
							$cursus->getEtablissement(),
							$cursus->getNote()
		));
	}

	public function delete(Cursus $cursus) {
		return $this->db->prepare("DELETE FROM `cursus` WHERE `cursus`.`INE` = ? AND `cursus`.`CODE_FORMATION` = ?;")
						->execute(array(
							$cursus->getId(),
							$cursus->getCodeFormation()
		));
	}

}
