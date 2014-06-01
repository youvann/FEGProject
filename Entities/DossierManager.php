<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DossierManager.php
 * @Purpose: Entité Dossier
 * @Author: Lionel Guissani
 */
class DossierManager {
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
	 * Récupère un dossier étudiant en fonction de son identifiant et d'un code formation
	 * @param $idEtudiant Identifiant de l'étudiant
	 * @param $codeFormation Code formation
	 * @return Dossier Dossier de l'étudiant
	 */
	public function find($idEtudiant, $codeFormation) {
        $q = $this->db->prepare("SELECT * FROM `dossier` WHERE `ID_ETUDIANT` = ? AND `CODE_FORMATION` = ?;");
        $q->execute(array($idEtudiant, $codeFormation));
        $rs = $q->fetch();
        return new Dossier($rs['ID_ETUDIANT'], $rs['INE'], $rs['GENRE'], $rs['CODE_FORMATION'], $rs['AUTRE'], $rs['NOM'], $rs['PRENOM'], $rs['ADRESSE'], $rs['COMPLEMENT'], $rs['CODE_POSTAL'], $rs['VILLE'], $rs['DATE_NAISSANCE'], $rs['LIEU_NAISSANCE'], $rs['FIXE'], $rs['PORTABLE'], $rs['MAIL'], $rs['LANGUES'], $rs['NATIONALITE'], $rs['SERIE_BAC'], $rs['ANNEE_BAC'], $rs['ETABLISSEMENT_BAC'], $rs['DEPARTEMENT_BAC'], $rs['PAYS_BAC'], $rs['ACTIVITE'], $rs['TITULAIRE'], $rs['VILLE_PREFEREE'], $rs['AUTRES_ELEMENTS'], $rs['INFORMATIONS']);
    }

	/**
	 * @param Formation $formation Formation
	 * @return array Tous les dossiers étudiants dans cette formation
	 */
	public function findAllByFormation(Formation $formation) {
        $dossiers = array();
        $q        = $this->db->prepare("SELECT * FROM `dossier` WHERE `CODE_FORMATION` = ?;");
        $q->execute(array($formation->getCodeFormation()));
        $rs = $rs = $q->fetchAll();
        foreach ($rs as $dossier) {
            $dossiers[] = new Dossier($dossier['ID_ETUDIANT'], $dossier['INE'], $dossier['GENRE'], $dossier['CODE_FORMATION'], $dossier['AUTRE'], $dossier['NOM'], $dossier['PRENOM'], $dossier['ADRESSE'], $dossier['COMPLEMENT'], $dossier['CODE_POSTAL'], $dossier['VILLE'], $dossier['DATE_NAISSANCE'], $dossier['LIEU_NAISSANCE'], $dossier['FIXE'], $dossier['PORTABLE'], $dossier['MAIL'], $dossier['LANGUES'], $dossier['NATIONALITE'], $dossier['SERIE_BAC'], $dossier['ANNEE_BAC'], $dossier['ETABLISSEMENT_BAC'], $dossier['DEPARTEMENT_BAC'], $dossier['PAYS_BAC'], $dossier['ACTIVITE'], $dossier['TITULAIRE'], $dossier['VILLE_PREFEREE'], $dossier['AUTRES_ELEMENTS'], $dossier['INFORMATIONS']);
        }
        return $dossiers;
    }

	/**
	 * Enregistre un dossier étudiant
	 * @param Dossier $dossier Dossier étudiant
	 * @return bool R2sultat de l'opération
	 */
	public function insert(Dossier $dossier) {
        return $this->db->prepare("INSERT INTO `dossier` (`ID_ETUDIANT`, `INE`, `GENRE`, `CODE_FORMATION`, `AUTRE`, `NOM`, `PRENOM`, `ADRESSE`, `COMPLEMENT`, `CODE_POSTAL`, `VILLE`, `DATE_NAISSANCE`, `LIEU_NAISSANCE`, `FIXE`, `PORTABLE`, `MAIL`, `LANGUES`, `NATIONALITE`, `SERIE_BAC`, `ANNEE_BAC`, `ETABLISSEMENT_BAC`, `DEPARTEMENT_BAC`, `PAYS_BAC`, `ACTIVITE`, `VILLE_PREFEREE`, `TITULAIRE`, `AUTRES_ELEMENTS`, `INFORMATIONS`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")
            ->execute(array(
				$dossier->getIdEtudiant(),
                $dossier->getIne(),
                $dossier->getGenre(),
                $dossier->getCodeFormation(),
                $dossier->getAutre(),
                $dossier->getNom(),
                $dossier->getPrenom(),
                $dossier->getAdresse(),
                $dossier->getComplement(),
                $dossier->getCodePostal(),
                $dossier->getVille(),
                $dossier->getDateNaissance(),
                $dossier->getLieuNaissance(),
                $dossier->getFixe(),
                $dossier->getPortable(),
                $dossier->getMail(),
                $dossier->getLangues(),
                $dossier->getNationalite(),
                $dossier->getSerieBac(),
                $dossier->getAnneeBac(),
                $dossier->getEtablissementBac(),
                $dossier->getDepartementBac(),
                $dossier->getPaysBac(),
                $dossier->getActivite(),
				$dossier->getVillePreferee(),
                $dossier->getTitulaire(),
                $dossier->getAutresElements(),
                $dossier->getInformations()
            ));
    }

	/**
	 * Supprime un dossier étudiant
	 * @param Dossier $dossier Dossier étudiant
	 * @return bool Résultat de l'opération
	 */
	public function delete(Dossier $dossier) {
        return $this->db->prepare("DELETE FROM `dossier` WHERE `ID_ETUDIANT` = ?;")
            ->execute(array(
                $dossier->getIdEtudiant()
            ));
    }

}
