<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DossierPdfManager.php
 * @Purpose: Entité DossierPdf
 * @Author: Lionel Guissani
 */
class DossierPdfManager {
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
	 * Récupère un dossier pdf en fonction de son identifiant
	 * @param $id string Identifiant du dossier pdf
	 * @return DossierPdf Dossier pdf
	 */
	public function find($id) {
        $q = $this->db->prepare("SELECT * FROM `dossier_pdf` WHERE `ID` = ?;");
        $q->execute(array($id));
        $rs = $q->fetch();
        return new DossierPdf($rs['ID'], $rs['NOM'], $rs['INFORMATIONS_PREALABLES'], $rs['INFORMATIONS'], $rs['MODALITES'], $rs['CODE_FORMATION']);
    }

	/**
	 * Retourne tous les dossiers pdf d'une formation
	 * @param Formation $formation Formation
	 * @return array Tous les dossiers pdf d'une formation
	 */
	public function findAllByFormation(Formation $formation) {
        $dossiers = array();
        $q        = $this->db->prepare("SELECT * FROM `dossier_pdf` WHERE `CODE_FORMATION` = ?;");
        $q->execute(array($formation->getCodeFormation()));
        $rs = $rs = $q->fetchAll();
        foreach ($rs as $dossier) {
            $dossiers[] = new DossierPdf($dossier['ID'], $dossier['NOM'], $dossier['INFORMATIONS_PREALABLES'], $dossier['INFORMATIONS'], $dossier['MODALITES'], $dossier['CODE_FORMATION']);
        }
        return $dossiers;
    }

	/**
	 * Retourne tous les dossiers pdf
	 * @return array Tous les dossiers pdf
	 */
    public function findAll(){
        $dossiers = array ();
        $rs = $this->db->query("SELECT * FROM `dossier_pdf` ORDER BY `CODE_FORMATION`;")->fetchAll();
        foreach ($rs as $dossier) {
            $dossiers[] = new DossierPdf($dossier['ID'], $dossier['NOM'], $dossier['INFORMATIONS_PREALABLES'], $dossier['INFORMATIONS'], $dossier['MODALITES'], $dossier['CODE_FORMATION']);
        }
        return $dossiers;
    }

	/**
	 * Retourne tous les dossiers pdf ordonnés par nom
	 * @return array Tous les dossiers pdf ordonnés par nom
	 */
	public function myFindAll(){
		$dossiers = array ();
		$rs = $this->db->query("SELECT * FROM `dossier_pdf` WHERE `VISIBLE` = 1 ORDER BY `NOM`;")->fetchAll();
		foreach ($rs as $dossier) {
			$dossiers[] = new DossierPdf($dossier['ID'], $dossier['NOM'], $dossier['INFORMATIONS_PREALABLES'], $dossier['INFORMATIONS'], $dossier['MODALITES'], $dossier['CODE_FORMATION']);
		}
		return $dossiers;
	}

	/**
	 * Enregistre un dossier pdf
	 * @param DossierPdf $dossierPdf Dossier pdf
	 * @return bool Résultat de l'opération
	 */
	public function insert(DossierPdf $dossierPdf) {
        return $this->db->prepare("INSERT INTO `dossier_pdf` (`NOM`, `INFORMATIONS_PREALABLES`, `INFORMATIONS`, `MODALITES`, `CODE_FORMATION`) VALUES (?, ?, ?, ?, ?);")
            ->execute(array(
                $dossierPdf->getNom(),
		        $dossierPdf->getInformationsPrealables(),
				$dossierPdf->getInformations(),
				$dossierPdf->getModalites(),
                $dossierPdf->getCodeFormation()
            ));
    }

	/**
	 * Met à jour un dossier pdf
	 * @param DossierPdf $dossierPdf Dossier pdf
	 * @return bool Résultat de l'opération
	 */
    public function update(DossierPdf $dossierPdf) {
        return $this->db->prepare("UPDATE `dossier_pdf` SET `NOM` = ?, `INFORMATIONS_PREALABLES` = ?, `INFORMATIONS` = ?, `MODALITES` = ?, `CODE_FORMATION` = ? WHERE `ID` = ?;")
            ->execute(array(
                $dossierPdf->getNom(),
		        $dossierPdf->getInformationsPrealables(),
				$dossierPdf->getInformations(),
				$dossierPdf->getModalites(),
				$dossierPdf->getCodeFormation(),
				$dossierPdf->getId(),
            ));
    }
	/**
	 * Supprime un dossier pdf
	 * @param DossierPdf $dossierPdf Dossier pdf
	 * @return bool Résultat de l'opération
	 */
    public function delete(DossierPdf $dossierPdf) {
        return $this->db->prepare("DELETE FROM `dossier_pdf` WHERE `ID` = ?;")
            ->execute(array(
                $dossierPdf->getId()
            ));
    }

	/**
	 * Retourne la liste des liens
	 * @return array Liste des liens
	 */
	public function getLinks() {
		return $this->db->query("SELECT CONCAT('<a href=\"http://miage-aix-marseille.fr/candid_feg/?uc=formulaire&action=choixFormation&dossierPdf=', `ID`, '\">', `NOM`, '</a>') as lien FROM `dossier_pdf`;")->fetchAll();
	}
}
