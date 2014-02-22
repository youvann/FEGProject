<?php

// Manque insert
class DossierPdfManager {

    private $db;

    function __construct(PDO $db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->db = $db;
    }

    public function find($id) {
        $q = $this->db->prepare("SELECT * FROM `dossier_pdf` WHERE `ID` = ?;");
        $q->execute(array($id));
        $rs = $q->fetch();
        return new DossierPdf($rs['ID'], $rs['NOM'], $rs['CODE_FORMATION']);
    }

    public function findAllByFormation(Formation $formation) {
        $dossiers = array();
        $q        = $this->db->prepare("SELECT * FROM `dossier_pdf` WHERE `CODE_FORMATION` = ?;");
        $q->execute(array($formation->getCodeFormation()));
        $rs = $rs = $q->fetchAll();
        foreach ($rs as $dossier) {
            $dossiers[] = new DossierPdf($dossier['ID'], $dossier['NOM'], $dossier['CODE_FORMATION']);
        }
        return $dossiers;
    }

    public function insert(DossierPdf $dossierPdf) {
        return $this->db->prepare("INSERT INTO `dossier_pdf` (`NOM`,`CODE_FORMATION`) VALUES (?, ?);")
            ->execute(array(
                $dossierPdf->getNom(),
                $dossierPdf->getCodeFormation()
            ));
    }

    public function update(DossierPdf $dossierPdf) {
        return $this->db->prepare("UPDATE `dossier_pdf` SET `NOM` = ?, `CODE_FORMATION` = ? WHERE `ID` = ?;")
            ->execute(array(
                $dossierPdf->getNom(),
				$dossierPdf->getCodeFormation(),
				$dossierPdf->getId(),
            ));
    }

    public function delete(DossierPdf $dossierPdf) {
        return $this->db->prepare("DELETE FROM `dossier_pdf` WHERE `ID` = ?;")
            ->execute(array(
                $dossierPdf->getId()
            ));
    }

}
