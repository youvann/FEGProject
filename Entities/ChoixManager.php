<?php

class ChoixManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$rs = $this->db->prepare("SELECT * FROM `CHOIX` WHERE `ID` = ?;")
						->execute(array($id))->fetch();
		return new Choix($rs['ID'], $rs['INFORMATION'], $rs['TEXTE']);
	}

	public function findAll() {
		$lesChoix = array();
		$rs = $this->db->query("SELECT * FROM `CHOIX`;")->fetchAll();
		foreach ($rs as $unChoix) {
			$lesChoix[] = new Choix($unChoix['ID'], $unChoix['INFORMATION'], $unChoix['TEXTE']);
		}
		return $lesChoix;
	}
	
	public function findAllByInformation(Information $information) {
		$lesChoix = array();
		$q = $this->db->prepare("SELECT * FROM `CHOIX` WHERE `INFORMATION` = ?;");
		$q->execute(array($information->getId()));
		$rs = $q->fetchAll();
		foreach ($rs as $unChoix) {
			$lesChoix[] = new Choix($unChoix['ID'], $unChoix['INFORMATION'], $unChoix['TEXTE']);
		}
		return $lesChoix;
	}

	public function insert(Choix $choix) {
		return $this->db->prepare("INSERT INTO `choix` (`INFORMATION`, `TEXTE`) VALUES (?, ?);")
						->execute(array($choix->getInformation(), $choix->getTexte()));
	}

	public function update(Choix $choix) {
		return $this->db->prepare("UPDATE `CHOIX` SET `INFORMATION` = ?, `TEXTE` = ? WHERE `ID` = ?;")
						->execute(array($choix->getInformation(), $choix->getTexte(), $choix->getId()));
	}
	
	public function delete(Choix $choix) {
		return $this->db->prepare("DELETE FROM `CHOIX` WHERE `ID` = ?;")
						->execute(array($choix->getId()));
	}
}
