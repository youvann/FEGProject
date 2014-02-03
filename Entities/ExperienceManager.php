<?php

class ExperienceManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findAllByDossier(Dossier $dossier) {
		$lesExperiences = array();
		$q = $this->db->prepare("SELECT * FROM `experience` WHERE `INE` = ? AND `CODE_FORMATION` = ?;");
        $q->execute(array($dossier->getIne(), $dossier->getCodeFormation()));
        $rs = $q->fetchAll();
		foreach ($rs as $experience) {
			$lesExperiences[] = new Experience($experience['ID'], $experience['INE'], $experience['CODE_FORMATION'], $experience['MOIS_DEBUT'], $experience['ANNEE_DEBUT'], $experience['MOIS_FIN'], $experience['ANNEE_FIN'], $experience['ENTREPRISE'], $experience['FONCTION']);
		}
		return $lesExperiences;
	}

	public function insert(Experience $experience) {
		return $this->db->prepare("INSERT INTO `experience` (`INE`, `CODE_FORMATION`, `MOIS_DEBUT`, `ANNEE_DEBUT`, `MOIS_FIN`, `ANNEE_FIN`, `ENTREPRISE`, `FONCTION`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);")
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
		return $this->db->prepare("DELETE FROM `experience` WHERE `ID` = ?;")
						->execute(array($experience->getId()));
	}

}
