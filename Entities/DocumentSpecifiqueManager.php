<?php

// CHECK
class DocumentSpecifiqueManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `document_specifique` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new DocumentSpecifique($rs['ID'], $rs['DOSSIER_PDF'], $rs['NOM'], $rs['VISIBLE'], $rs['URL']);
	}

	public function findAllByDossierPdf(DossierPdf $dossierPdf) {
		$documentsSpecifiques = array();
		$q = $this->db->prepare("SELECT * FROM `document_specifique` WHERE `DOSSIER_PDF` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $documentSpecifique) {
			$documentsSpecifiques[] = new DocumentSpecifique($documentSpecifique['ID'], $documentSpecifique['DOSSIER_PDF'], $documentSpecifique['NOM'], $documentSpecifique['VISIBLE'], $documentSpecifique['URL']);
		}
		return $documentsSpecifiques;
	}

	public function findAllByDossierPdfVisible(DossierPdf $dossierPdf) {
		$documentsSpecifiques = array();
		$q = $this->db->prepare("SELECT * FROM `document_specifique` WHERE `DOSSIER_PDF` = ? AND `VISIBLE` = 1;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $documentSpecifique) {
			$documentsSpecifiques[] = new DocumentSpecifique($documentSpecifique['ID'], $documentSpecifique['DOSSIER_PDF'], $documentSpecifique['NOM'], $documentSpecifique['VISIBLE'], $documentSpecifique['URL']);
		}
		return $documentsSpecifiques;
	}

	public function insert(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("INSERT INTO `document_specifique` (`DOSSIER_PDF`, `NOM`, `URL`, `VISIBLE`) VALUES (?, ?, ?, ?);")
						->execute(array(
							$documentSpecifique->getDossierPdf(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getUrl(),
							$documentSpecifique->getVisible()
		));
	}

	public function update(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("UPDATE `document_specifique` SET `DOSSIER_PDF` = ?, `NOM` = ?, `VISIBLE` = ?, `URL` = ? WHERE `ID` = ?;")
						->execute(array(
							$documentSpecifique->getDossierPdf(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getVisible(),
							$documentSpecifique->getUrl(),
							$documentSpecifique->getId()
		));
	}

	public function delete(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("DELETE FROM `document_specifique` WHERE `ID` = ?;")
						->execute(array($documentSpecifique->getId()));
	}

}
