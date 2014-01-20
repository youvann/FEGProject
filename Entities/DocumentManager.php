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
		$rs = $this->db->prepare("SELECT * FROM `DOCUMENT` WHERE `ID` = ?;")
						->execute(array($id))->fetch();
		return new Document($rs['ID'], $rs['NOM']);
	}

	public function findAll() {
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `DOCUMENT;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new Document($document['ID'], $document['NOM']);
		}
		return $documents;
	}

	public function insert(Document $document) {
		return $this->db->prepare("INSERT INTO `DOCUMENT` (`NOM`) VALUES (?);")
						->execute(array($document->getNom()));
	}

	public function update(Document $document) {
		return $this->db->prepare("UPDATE `DOCUMENT` `NOM` = ? WHERE `ID` = ?;")
						->execute(array(
							$document->getNom(),
							$document->getId()
		));
	}

	public function delete(Document $document) {
		return $this->db->prepare("DELETE FROM `DOCUMENT_SPECIFIQUE` WHERE `ID` = ?;")
						->execute(array(
							$document->getId()
		));
	}

}
