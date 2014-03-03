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
		$q = $this->db->prepare("SELECT * FROM `cursus` WHERE `cursus`.`ID_ETUDIANT` = ? AND `cursus`.`CODE_FORMATION` = ?;");
        $q->execute(array($dossier->getIdEtudiant(), $dossier->getCodeFormation()));
        $rs = $q->fetchAll();

        foreach($rs as $cursus){
            $lesCursus[] = new Cursus($cursus['ID'], $cursus['ID_ETUDIANT'], $cursus['CODE_FORMATION'], $cursus['ANNEE_DEBUT'], $cursus['ANNEE_FIN'], $cursus['CURSUS'], $cursus['ETABLISSEMENT'], $cursus['NOTE'], $cursus['VALIDE']);
        }
        return $lesCursus;
	}

    public function findAllByDossierOrderedByAnneeFin (Dossier $dossier) {
        $lesCursus = array ();
        $q         = $this->db->prepare ("SELECT * FROM `cursus` WHERE `cursus`.`ID_ETUDIANT` = ? AND `cursus`.`CODE_FORMATION` = ? ORDER BY `cursus`.`ANNEE_FIN` DESC;");
        $q->execute (array ($dossier->getIdEtudiant (), $dossier->getCodeFormation ()));
        $rs = $q->fetchAll ();

        foreach ($rs as $cursus) {
            $lesCursus[] = new Cursus($cursus['ID'], $cursus['ID_ETUDIANT'], $cursus['CODE_FORMATION'], $cursus['ANNEE_DEBUT'], $cursus['ANNEE_FIN'], $cursus['CURSUS'], $cursus['ETABLISSEMENT'], $cursus['NOTE'], $cursus['VALIDE']);
        }
        return $lesCursus;
    }

    public function findLastYearValideByDossier(Dossier $dossier){
        $q = $this->db->prepare ("SELECT * FROM `cursus`
                                  WHERE `VALIDE`= 1 AND `cursus`.`ID_ETUDIANT` = ? AND
                                        `ANNEE_FIN` = (SELECT MAX(`ANNEE_FIN`) FROM `cursus` WHERE `cursus`.`ID_ETUDIANT` = ? AND `VALIDE`= 1);");
        $q->execute (array ($dossier->getIdEtudiant(), $dossier->getIdEtudiant ()));
        $rs = $q->fetch ();
        return new Cursus($rs['ID'], $rs['ID_ETUDIANT'], $rs['CODE_FORMATION'], $rs['ANNEE_DEBUT'], $rs['ANNEE_FIN'], $rs['CURSUS'], $rs['ETABLISSEMENT'], $rs['NOTE'], $rs['VALIDE']);
    }

	public function insert(Cursus $cursus) {
		return $this->db->prepare("INSERT INTO `cursus` (`ID_ETUDIANT`, `CODE_FORMATION`, `ANNEE_DEBUT`, `ANNEE_FIN`, `CURSUS`, `ETABLISSEMENT`, `NOTE`, `VALIDE`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);")
						->execute(array(
							$cursus->getIdEtudiant(),
							$cursus->getCodeFormation(),
							$cursus->getAnneeDebut(),
							$cursus->getAnneeFin(),
							$cursus->getCursus(),
							$cursus->getEtablissement(),
							$cursus->getNote(),
							$cursus->getValide()
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
