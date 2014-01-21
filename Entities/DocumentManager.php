<?php

// CHECK
class DocumentManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `DOCUMENT` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Document($rs['ID'], $rs['NOM']);
	}

	public function findAll() {
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `DOCUMENT`;")->fetchAll();
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
		return $this->db->prepare("UPDATE `DOCUMENT` SET `NOM` = ? WHERE `ID` = ?;")
						->execute(array(
							$document->getNom(),
							$document->getId()
		));
	}

	public function delete(Document $document) {
		return $this->db->prepare("DELETE FROM `DOCUMENT` WHERE `ID` = ?;")
						->execute(array($document->getId()));
	}

}
