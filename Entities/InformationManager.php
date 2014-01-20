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
		$rs = $this->db->prepare("SELECT * FROM `INFORMATION` WHERE `ID` = ?;")
						->execute(array($id))->fetch();
		return new InformationSupp($rs['CODE_ETAPE'], $rs['CODE_VET'], $rs['ID'], $rs['LIBEL_INFORMATION'], $rs['REQUIS'], $rs['ID_TYPE_ELEMENT']);
	}

	public function findAllByFormation($codeFormation) {
		$informations = array();
		$rs = $this->db->prepare("SELECT * FROM `INFORMATION` WHERE `CODE` = ?;")
						->execute(array($codeFormation))->fetchAll();
		foreach ($rs as $information) {
			$informations[] = new Information($information['ID'], $information['NOM'], $information['CODE'], $information['LIBELLE'], $information['EXPLICATIONS'], $information['ORDRE']);
		}
		return $informations;
	}

	public function insert(Information $information) {
		return $this->db->prepare("INSERT INTO `information` (`NOM`, `CODE`, `LIBELLE`, `EXPLICATIONS`, `ORDRE`) VALUES (?, ?, ?, ?, ?, ?);")
						->execute(array(
							$information->getNom(),
							$information->getCode(),
							$information->getLibelle(),
							$information->getExplications(),
							$information->getOrdre()
		));
	}

	public function update(Information $information) {
		return $this->db->prepare("UPDATE `information` SET `NOM` = ?, `CODE` = ?, `LIBELLE` = ?, `EXPLICATIONS` = ?, `ORDRE` = ? WHERE `ID` = ?;")
						->execute(array(
							$information->getNom(),
							$information->getCode(),
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

}
