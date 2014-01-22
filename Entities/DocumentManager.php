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
		return new Document($rs['ID'], $rs['NOM'], $rs['MULTIPLE']);
	}

	public function findAll() {
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `DOCUMENT`;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new Document($document['ID'], $document['NOM'], $document['MULTIPLE']);
		}
		return $documents;
	}

	public function insert(Document $document) {
		return $this->db->prepare("INSERT INTO `DOCUMENT` (`NOM`, `MULTIPLE`) VALUES (?, ?);")
						->execute(array($document->getNom(), $document->getMultiple()));
	}

	public function update(Document $document) {
		return $this->db->prepare("UPDATE `DOCUMENT` SET `NOM` = ?, `MULTIPLE` = ? WHERE `ID` = ?;")
						->execute(array(
							$document->getNom(),
							$document->getMultiple(),
							$document->getId()
		));
	}

	public function delete(Document $document) {
		return $this->db->prepare("DELETE FROM `DOCUMENT` WHERE `ID` = ?;")
						->execute(array($document->getId()));
	}

}
