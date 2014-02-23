<?php

// Manque insert
class DossierManager {

    private $db;

    function __construct(PDO $db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->db = $db;
    }

    public function find($idEtudiant, $codeFormation) {
        $q = $this->db->prepare("SELECT * FROM `dossier` WHERE `ID_ETUDIANT` = ? AND `CODE_FORMATION` = ?;");
        $q->execute(array($idEtudiant, $codeFormation));
        $rs = $q->fetch();
        return new Dossier($rs['ID_ETUDIANT'], $rs['INE'], $rs['GENRE'], $rs['CODE_FORMATION'], $rs['AUTRE'], $rs['NOM'], $rs['PRENOM'], $rs['ADRESSE'], $rs['COMPLEMENT'], $rs['CODE_POSTAL'], $rs['VILLE'], $rs['DATE_NAISSANCE'], $rs['LIEU_NAISSANCE'], $rs['FIXE'], $rs['PORTABLE'], $rs['MAIL'], $rs['LANGUES'], $rs['NATIONALITE'], $rs['SERIE_BAC'], $rs['ANNEE_BAC'], $rs['ETABLISSEMENT_BAC'], $rs['DEPARTEMENT_BAC'], $rs['PAYS_BAC'], $rs['ACTIVITE'], $rs['TITULAIRE'], $rs['VILLE_PREFEREE'], $rs['AUTRES_ELEMENTS'], $rs['INFORMATIONS']);
    }

    public function findAllByFormation(Formation $formation) {
        $dossiers = array();
        $q        = $this->db->prepare("SELECT * FROM `dossier` WHERE `CODE_FORMATION` = ?;");
        $q->execute(array($formation->getCodeFormation()));
        $rs = $rs = $q->fetchAll();
        foreach ($rs as $dossier) {
            $dossiers[] = new Dossier($dossier['ID_ETUDIANT'], $dossier['INE'], $dossier['GENRE'], $dossier['CODE_FORMATION'], $dossier['AUTRE'], $dossier['NOM'], $dossier['PRENOM'], $dossier['ADRESSE'], $dossier['COMPLEMENT'], $dossier['CODE_POSTAL'], $dossier['VILLE'], $dossier['DATE_NAISSANCE'], $dossier['LIEU_NAISSANCE'], $dossier['FIXE'], $dossier['PORTABLE'], $dossier['MAIL'], $dossier['LANGUES'], $dossier['NATIONALITE'], $dossier['SERIE_BAC'], $dossier['ANNEE_BAC'], $dossier['ETABLISSEMENT_BAC'], $dossier['DEPARTEMENT_BAC'], $dossier['PAYS_BAC'], $dossier['ACTIVITE'], $dossier['TITULAIRE'], $dossier['AUTRES_ELEMENTS'], $dossier['INFORMATIONS']);
        }
        return $dossiers;
    }

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
                $dossier->getTitulaire(),
                $dossier->getVillePreferee(),
                $dossier->getAutresElements(),
                $dossier->getInformations()
            ));
    }

    public function delete(Dossier $dossier) {
        return $this->db->prepare("DELETE FROM `dossier` WHERE `ID_ETUDIANT` = ?;")
            ->execute(array(
                $dossier->getIdEtudiant()
            ));
    }

}
