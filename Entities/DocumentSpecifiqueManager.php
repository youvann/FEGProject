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
		$rs = $this->db->prepare("SELECT * FROM `DOCUMENT_SPECIFIQUE` WHERE `ID` = ?;")
						->execute(array($id))->fetch();
		return new DocumentSpecifique($rs['ID'], $rs['CODE'], $rs['NOM'], $rs['URL']);
	}

	public function findAllByFormation($code) {
		$documentsSpecifiques = array();
		$q = $this->db->prepare("SELECT * FROM `DOCUMENT_SPECIFIQUE` WHERE `CODE` = ?;");
		$q->execute(array($code));
		$rs = $q->fetchAll();
		foreach ($rs as $documentSpecifique) {
			$documentsSpecifiques[] = new DocumentSpecifique($documentSpecifique['ID'], $documentSpecifique['CODE'], $documentSpecifique['NOM'], $documentSpecifique['URL']);
		}
		return $documentsSpecifiques;
	}

	public function insert(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("INSERT INTO `DOCUMENT_SPECIFIQUE` (`CODE`, `NOM`, `URL`) VALUES (?, ?, ?);")
						->execute(array(
							$documentSpecifique->getCode(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getUrl()
		));
	}

	public function update(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("UPDATE `DOCUMENT_SPECIFIQUE` SET `CODE` = ?, `NOM` = ?, `URL` = ? WHERE `ID` = ?;")
						->execute(array(
							$documentSpecifique->getCode(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getUrl(),
							$documentSpecifique->getId()
		));
	}

	public function delete(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("DELETE FROM `DOCUMENT_SPECIFIQUE` WHERE `ID` = ?;")
						->execute(array(
							$documentSpecifique->getId()
		));
	}

}
