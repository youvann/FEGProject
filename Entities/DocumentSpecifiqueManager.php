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
		$q = $this->db->prepare("SELECT * FROM `DOCUMENT_SPECIFIQUE` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new DocumentSpecifique($rs['ID'], $rs['DOSSIER_PDF'], $rs['NOM'], $rs['URL']);
	}

	public function findAllByDossierPdf(DossierPdf $dossierPdf) {
		$documentsSpecifiques = array();
		$q = $this->db->prepare("SELECT * FROM `DOCUMENT_SPECIFIQUE` WHERE `DOSSIER_PDF` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $documentSpecifique) {
			$documentsSpecifiques[] = new DocumentSpecifique($documentSpecifique['ID'], $documentSpecifique['DOSSIER_PDF'], $documentSpecifique['NOM'], $documentSpecifique['URL']);
		}
		return $documentsSpecifiques;
	}

	public function insert(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("INSERT INTO `DOCUMENT_SPECIFIQUE` (`DOSSIER_PDF`, `NOM`, `URL`) VALUES (?, ?, ?);")
						->execute(array(
							$documentSpecifique->getDossierPdf(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getUrl()
		));
	}

	public function update(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("UPDATE `DOCUMENT_SPECIFIQUE` SET `DOSSIER_PDF` = ?, `NOM` = ?, `URL` = ? WHERE `ID` = ?;")
						->execute(array(
							$documentSpecifique->getDossierPdf(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getUrl(),
							$documentSpecifique->getId()
		));
	}

	public function delete(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("DELETE FROM `DOCUMENT_SPECIFIQUE` WHERE `ID` = ?;")
						->execute(array($documentSpecifique->getId()));
	}

}
