<?php
/**
 * @Project: FEG Project
 * @File: /Entities/ExperienceManager.php
 * @Purpose: Entité Experience
 * @Author: Lionel Guissani
 */
class ExperienceManager {
	/**
	 * @var PDO Connexion à la base de données
	 */
	private $db;

	/**
	 * @param PDO $db Connexion à la base de données
	 */
	function __construct(PDO $db) {
		$this->setDb($db);
	}

	/**
	 * Accesseur en écriture de l'attribut db
	 * @param PDO $db
	 */
	public function setDb(PDO $db) {
		$this->db = $db;
	}

	/**
	 * Retourne les expériences liées au dossier étudiant
	 * @param Dossier $dossier Dossier étudiant
	 * @return array Expériences liées au dossier étudiant
	 */
	public function findAllByDossier(Dossier $dossier) {
		$lesExperiences = array();
		$q = $this->db->prepare("SELECT * FROM `experience` WHERE `ID_ETUDIANT` = ? AND `CODE_FORMATION` = ?;");
        $q->execute(array($dossier->getIdEtudiant(), $dossier->getCodeFormation()));
        $rs = $q->fetchAll();
		foreach ($rs as $experience) {
			$lesExperiences[] = new Experience($experience['ID'], $experience['ID_ETUDIANT'], $experience['CODE_FORMATION'], $experience['MOIS_DEBUT'], $experience['ANNEE_DEBUT'], $experience['MOIS_FIN'], $experience['ANNEE_FIN'], $experience['ENTREPRISE'], $experience['FONCTION']);
		}
		return $lesExperiences;
	}

	/**
	 * Retourne les expériences liées au dossier étudiant ordonnéés par année
	 * @param Dossier $dossier Dossier étudiant
	 * @return array Expériences liées au dossier étudiant ordonnéés par année
	 */
    public function findAllByDossierOrderedByAnneeFin (Dossier $dossier) {
        $lesExperiences = array ();
        $q              = $this->db->prepare ("SELECT * FROM `experience` WHERE `ID_ETUDIANT` = ? AND `CODE_FORMATION` = ? ORDER BY `ANNEE_FIN` DESC;");
        $q->execute (array ($dossier->getIdEtudiant (), $dossier->getCodeFormation ()));
        $rs = $q->fetchAll ();
        foreach ($rs as $experience) {
            $lesExperiences[] = new Experience($experience['ID'], $experience['ID_ETUDIANT'], $experience['CODE_FORMATION'], $experience['MOIS_DEBUT'], $experience['ANNEE_DEBUT'], $experience['MOIS_FIN'], $experience['ANNEE_FIN'], $experience['ENTREPRISE'], $experience['FONCTION']);
        }
        return $lesExperiences;
    }

	/**
	 * Enregistre une expérience
	 * @param Experience $experience
	 * @return bool Résultat de l'opération
	 */
	public function insert(Experience $experience) {
		return $this->db->prepare("INSERT INTO `experience` (`ID_ETUDIANT`, `CODE_FORMATION`, `MOIS_DEBUT`, `ANNEE_DEBUT`, `MOIS_FIN`, `ANNEE_FIN`, `ENTREPRISE`, `FONCTION`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);")
						->execute(array(
							$experience->getIdEtudiant(),
							$experience->getCodeFormation(),
							$experience->getMoisDebut(),
							$experience->getAnneeDebut(),
							$experience->getMoisFin(),
							$experience->getAnneeFin(),
							$experience->getEntreprise(),
							$experience->getFonction())
		);
	}

	/**
	 * Supprime une expérience
	 * @param Experience $experience
	 * @return bool Résultat de l'opération
	 */
	public function delete(Experience $experience) {
		return $this->db->prepare("DELETE FROM `experience` WHERE `ID` = ?;")
						->execute(array($experience->getId()));
	}

}
