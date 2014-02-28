<?php

// CHECK
class DocumentGeneralManager
{

	private $db;

	function __construct(PDO $db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->db = $db;
	}

	public function find($id)
	{

		$q = $this->db->prepare("SELECT * FROM `document_general` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new DocumentGeneral($rs['ID'], $rs['NOM'], $rs['VISIBLE']);
	}

	public function findAll()
	{
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `document_general`;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new DocumentGeneral($document['ID'], $document['NOM'], $document['VISIBLE']);
		}
		return $documents;
	}

	public function findAllVisible()
	{
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `document_general` WHERE `VISIBLE` = 1;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new DocumentGeneral($document['ID'], $document['NOM'], $document['VISIBLE']);
		}
		return $documents;
	}

	public function insert(DocumentGeneral $documentGeneral)
	{
		return $this->db->prepare("INSERT INTO `document_general` (`NOM`, `VISIBLE`) VALUES (?, ?);")
			->execute(array(
				$documentGeneral->getNom(),
				$documentGeneral->getVisible()));
	}

	public function update(DocumentGeneral $documentGeneral)
	{
		return $this->db->prepare("UPDATE `document_general` SET `NOM` = ?, `VISIBLE` = ? WHERE `ID` = ?;")
			->execute(array(
				$documentGeneral->getNom(),
				$documentGeneral->getVisible(),
				$documentGeneral->getId()
			));
	}

	public function delete(DocumentGeneral $documentGeneral)
	{
		return $this->db->prepare("DELETE FROM `document_general` WHERE `ID` = ?;")
			->execute(array($documentGeneral->getId()));
	}

}
