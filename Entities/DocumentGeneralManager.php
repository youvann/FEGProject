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

		$q = $this->db->prepare("SELECT * FROM `document_general` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new DocumentGeneral($rs['ID'], $rs['NOM']);
	}

	public function findAll() {
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `document_general`;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new DocumentGeneral($document['ID'], $document['NOM']);
		}
		return $documents;
	}

	public function insert(DocumentGeneral $document) {
		return $this->db->prepare("INSERT INTO `document_general` (`NOM`) VALUES (?);")
						->execute(array($document->getNom()));
	}

	public function update(DocumentGeneral $document) {
		return $this->db->prepare("UPDATE `document_general` SET `NOM` = ? WHERE `ID` = ?;")
						->execute(array(
							$document->getNom(),
							$document->getId()
		));
	}

	public function delete(DocumentGeneral $document) {
		return $this->db->prepare("DELETE FROM `document_general` WHERE `ID` = ?;")
						->execute(array($document->getId()));
	}

}
