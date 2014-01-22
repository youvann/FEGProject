<?php

// CHECK
class InformationManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$q = $this->db->prepare("SELECT * FROM `INFORMATION` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Information($rs['ID'], $rs['TYPE'], $rs['CODE_FORMATION'], $rs['LIBELLE'], $rs['EXPLICATIONS'], $rs['ORDRE']);
	}

	public function findAllByFormation($codeFormation) {
		$informations = array();
		$q = $this->db->prepare("SELECT * FROM `INFORMATION` WHERE `CODE_FORMATION` = ?;");
		$q->execute(array($codeFormation));
		$rs = $q->fetchAll();
		foreach ($rs as $information) {
			$informations[] = new Information($information['ID'], $information['TYPE'], $information['CODE_FORMATION'], $information['LIBELLE'], $information['EXPLICATIONS'], $information['ORDRE']);
		}
		return $informations;
	}

	public function insert(Information $information) {
		return $this->db->prepare("INSERT INTO `information` (`TYPE`, `CODE_FORMATION`, `LIBELLE`, `EXPLICATIONS`, `ORDRE`) VALUES (?, ?, ?, ?, ?);")
						->execute(array(
							$information->getType(),
							$information->getCodeFormation(),
							$information->getLibelle(),
							$information->getExplications(),
							$information->getOrdre()
		));
	}

	public function update(Information $information) {
		return $this->db->prepare("UPDATE `information` SET `TYPE` = ?, `CODE_FORMATION` = ?, `LIBELLE` = ?, `EXPLICATIONS` = ?, `ORDRE` = ? WHERE `ID` = ?;")
						->execute(array(
							$information->getType(),
							$information->getCodeFormation(),
							$information->getLibelle(),
							$information->getExplications(),
							$information->getOrdre(),
							$information->getId(),
		));
	}

	public function delete(Information $information) {
		return $this->db->prepare("DELETE FROM `INFORMATION` WHERE `ID` = ?;")
						->execute(array($information->getId()));
	}

	public function maxId() {
		$rs = $this->db->query("SELECT MAX(`ID`) as ID FROM `INFORMATION`;")->fetch();
		return $rs['ID'];
	}

}
