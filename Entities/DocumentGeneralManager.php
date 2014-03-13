<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DocumentGeneralManager.php
 * @Purpose: Entité DocumentGeneral
 * @Author: Lionel Guissani
 */
class DocumentGeneralManager {
	/**
	 * @var PDO Connexion à la base de données
	 */
	private $db;

	/**
	 * @param PDO $db Connexion à la base de données
	 */
	function __construct(PDO $db) {
		$this->setDb($db);
	}

	/**
	 * Accesseur en écriture de l'attribut db
	 * @param PDO $db
	 */
	public function setDb(PDO $db) {
		$this->db = $db;
	}
	/**
	 * Récupère un document général en fonction de son identifiant
	 * @param $id string Identifiant du document général
	 * @return Choix Choix
	 */
	public function find($id)
	{

		$q = $this->db->prepare("SELECT * FROM `document_general` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new DocumentGeneral($rs['ID'], $rs['NOM'], $rs['VISIBLE']);
	}
	/**
	 * Récupère tous les documents généraux
	 * @return array Tous les documents généraux
	 */
	public function findAll()
	{
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `document_general`;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new DocumentGeneral($document['ID'], $document['NOM'], $document['VISIBLE']);
		}
		return $documents;
	}

	/**
	 * Récupère tous les documents généraux demandés en préinscription
	 * @return array Tous les documents généraux demandés en préinscription
	 */
	public function findAllVisible()
	{
		$documents = array();
		$rs = $this->db->query("SELECT * FROM `document_general` WHERE `VISIBLE` = 1;")->fetchAll();
		foreach ($rs as $document) {
			$documents[] = new DocumentGeneral($document['ID'], $document['NOM'], $document['VISIBLE']);
		}
		return $documents;
	}

	/**
	 * Enregistre un document général
	 * @param DocumentGeneral $documentGeneral
	 * @return bool Résultat de l'opération
	 */
	public function insert(DocumentGeneral $documentGeneral)
	{
		return $this->db->prepare("INSERT INTO `document_general` (`NOM`, `VISIBLE`) VALUES (?, ?);")
			->execute(array(
				$documentGeneral->getNom(),
				$documentGeneral->getVisible()));
	}
	/**
	 * Met à jour un document général
	 * @param DocumentGeneral $documentGeneral
	 * @return bool Résultat de l'opération
	 */
	public function update(DocumentGeneral $documentGeneral)
	{
		return $this->db->prepare("UPDATE `document_general` SET `NOM` = ?, `VISIBLE` = ? WHERE `ID` = ?;")
			->execute(array(
				$documentGeneral->getNom(),
				$documentGeneral->getVisible(),
				$documentGeneral->getId()
			));
	}

	/**
	 * Supprime un document général
	 * @param DocumentGeneral $documentGeneral
	 * @return bool Résultat de l'opération
	 */
	public function delete(DocumentGeneral $documentGeneral)
	{
		return $this->db->prepare("DELETE FROM `document_general` WHERE `ID` = ?;")
			->execute(array($documentGeneral->getId()));
	}
}
