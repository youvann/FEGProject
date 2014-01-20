<?php

class ExperienceManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findAllByEtudiantAndFormation($ine, $codeFormation) {
		$lesCursus = array();
		$rs = $this->db->prepare("SELECT * FROM `EXPERIENCE` WHERE `INE` = ? AND `CODE_FORMATION` = ?;")
				->execute(array($ine, $codeFormation));
		foreach ($rs as $cursus) {
			$lesCursus[] = new Cursus($cursus['ID'], $cursus['INE'], $cursus['CODE_FORMATION'], $cursus['MOIS_DEBUT'], $cursus['ANNEE_DEBUT'], $cursus['MOIS_FIN'], $cursus['ANNEE_FIN'], $cursus['ENTREPRISE'], $cursus['FONCTION']);
		}
		return $lesCursus;
	}

	public function insert(Experience $experience) {
		return $this->db->prepare("INSERT INTO `EXPERIENCE` (`INE`, `CODE_FORMATION`, `MOIS_DEBUT`, `ANNEE_DEBUT`, `MOIS_FIN`, `ANNEE_FIN`, `ENTREPRISE`, `FONCTION`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);")
						->execute(array(
							$experience->getIne(),
							$experience->getCodeFormation(),
							$experience->getMoisDebut(),
							$experience->getAnneeDebut(),
							$experience->getMoisFin(),
							$experience->getAnneeFin(),
							$experience->getEntreprise(),
							$experience->getFonction())
		);
	}

	public function delete(Experience $experience) {
		return $this->db->prepare("DELETE FROM `EXPERIENCE` WHERE `ID` = ?;")
						->execute(array($experience->getId()));
	}

}
