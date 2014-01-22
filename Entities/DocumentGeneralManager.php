<?php

// CHECK
class DocumentGeneralManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {

		$q = $this->db->prepare("SELECT * FROM `DOCUMENT_GENERAL` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new DocumentGeneral($rs['ID'], $rs['NOM'], $rs['MULTIPLE']);
	}

	public function findAll() {
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `DOCUMENT_GENERAL`;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new DocumentGeneral($document['ID'], $document['NOM'], $document['MULTIPLE']);
		}
		return $documents;
	}

	public function insert(DocumentGeneral $document) {
		return $this->db->prepare("INSERT INTO `DOCUMENT_GENERAL` (`NOM`, `MULTIPLE`) VALUES (?, ?);")
						->execute(array($document->getNom(), $document->getMultiple()));
	}

	public function update(DocumentGeneral $document) {
		return $this->db->prepare("UPDATE `DOCUMENT_GENERAL` SET `NOM` = ?, `MULTIPLE` = ? WHERE `ID` = ?;")
						->execute(array(
							$document->getNom(),
							$document->getMultiple(),
							$document->getId()
		));
	}

	public function delete(DocumentGeneral $document) {
		return $this->db->prepare("DELETE FROM `DOCUMENT_GENERAL` WHERE `ID` = ?;")
						->execute(array($document->getId()));
	}

}
