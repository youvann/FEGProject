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
		$q = $this->db->prepare("SELECT * FROM `CURSUS` WHERE `CURSUS`.`INE` = ? AND `CURSUS`.`CODE_FORMATION` = ?;");
        $q->execute(array($dossier->getIne(), $dossier->getCodeFormation()));
        $rs = $q->fetchAll();

        foreach($rs as $cursus){
            $lesCursus[] = new Cursus($cursus['ID'], $cursus['INE'], $cursus['CODE_FORMATION'], $cursus['ANNEE_DEBUT'], $cursus['ANNEE_FIN'], $cursus['CURSUS'], $cursus['ETABLISSEMENT'], $cursus['VALIDE']);
        }
        return $lesCursus;
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
