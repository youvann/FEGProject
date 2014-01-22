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
		return new DocumentSpecifique($rs['ID'], $rs['CODE'], $rs['NOM'], $rs['URL'], $rs['MULTIPLE']);
	}

	public function findAllByFormation($code) {
		$documentsSpecifiques = array();
		$q = $this->db->prepare("SELECT * FROM `DOCUMENT_SPECIFIQUE` WHERE `CODE` = ?;");
		$q->execute(array($code));
		$rs = $q->fetchAll();
		foreach ($rs as $documentSpecifique) {
			$documentsSpecifiques[] = new DocumentSpecifique($documentSpecifique['ID'], $documentSpecifique['CODE'], $documentSpecifique['NOM'], $documentSpecifique['URL'],$documentSpecifique['MULTIPLE']);
		}
		return $documentsSpecifiques;
	}

	public function insert(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("INSERT INTO `DOCUMENT_SPECIFIQUE` (`CODE`, `NOM`, `URL`, `MULTIPLE`) VALUES (?, ?, ?, ?);")
						->execute(array(
							$documentSpecifique->getCode(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getUrl(),
                            $documentSpecifique->getMultiple()
		));
	}

	public function update(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("UPDATE `DOCUMENT_SPECIFIQUE` SET `CODE` = ?, `NOM` = ?, `URL` = ?, `MULTIPLE` = ? WHERE `ID` = ?;")
						->execute(array(
							$documentSpecifique->getCode(),
							$documentSpecifique->getNom(),
							$documentSpecifique->getUrl(),
							$documentSpecifique->getId(),
                            $documentSpecifique->getMultiple()
		));
	}

	public function delete(DocumentSpecifique $documentSpecifique) {
		return $this->db->prepare("DELETE FROM `DOCUMENT_SPECIFIQUE` WHERE `ID` = ?;")
						->execute(array($documentSpecifique->getId()));
	}

}
