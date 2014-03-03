<?php

// CHECK
class DiplomeManager {

    private $db;

    function __construct (PDO $db) {
        $this->setDb ($db);
    }

    public function setDb (PDO $db) {
        $this->db = $db;
    }

    public function find ($id) {
        $q = $this->db->prepare ("SELECT * FROM `diplome_hors_feg` WHERE `ID` = ?;");
        $q->execute (array ($id));
        $rs = $q->fetch ();
        return new Diplome($rs['ID'], $rs['NOM'], $rs['DOSSIER_PDF']);
    }

    public function findAllByDossierPdf (DossierPdf $dossierPdf) {
        $diplomes = array ();
        $q        = $this->db->prepare ("SELECT * FROM `diplome_hors_feg` WHERE `DOSSIER_PDF` = ?;");
        $q->execute (array ($dossierPdf->getId ()));
        $rs = $q->fetchAll ();
        foreach ($rs as $diplome) {
            $diplomes[] = new Diplome($diplome['ID'], $diplome['NOM'], $diplome['DOSSIER_PDF']);
        }
        return $diplomes;
    }

    public function insert (Diplome $diplome) {
        return $this->db->prepare ("INSERT INTO `diplome_hors_feg` (`NOM`, `DOSSIER_PDF`) VALUES (?, ?);")->execute (array ($diplome->getNom (), $diplome->getDossierPdf ()));
    }

    public function update (Diplome $diplome) {
        return $this->db->prepare ("UPDATE `diplome_hors_feg` SET `NOM` = ?, `DOSSIER_PDF` = ? WHERE `ID` = ?;")->execute (array ($diplome->getNom (), $diplome->getDossierPdf (), $diplome->getId ()));
    }

    public function delete (Diplome $diplome) {
        return $this->db->prepare ("DELETE FROM `diplome_hors_feg` WHERE `ID` = ?;")->execute (array ($diplome->getId ()));
    }

}
