<?php

class TypeChampsInformationsManager {
private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($id) {
		$rs = $this->db->prepare("SELECT * FROM `TYPE_CHAMPS_INFORMATIONS` WHERE `ID` = ?;")
						->execute(array($id))->fetch();
		return new TypeChampsInformations($rs['ID'], $rs['NOM_TYPE']);
	}

	public function findAll() {
		$typesChampsInformations = array();
		$rs = $this->db->query("SELECT * FROM `TYPE_CHAMPS_INFORMATIONS`;")->fetchAll();
		foreach ($rs as $typeChampsInformations) {
			$typesChampsInformations[] = new TypeChampsInformations($typeChampsInformations['ID'], $typeChampsInformations['NOM_TYPE']);
		}
		return $typesChampsInformations;
	}

	public function insert(TypeChampsInformations $typeChampsInformations) {
		return $this->db->prepare("INSERT INTO `TYPE_CHAMPS_INFORMATIONS` (`NOM_TYPE`) VALUES (?);")
						->execute(array($typeChampsInformations->getNomType()));
	}

	public function update(TypeChampsInformations $typeChampsInformations) {
		return $this->db->prepare("UPDATE `TYPE_CHAMPS_INFORMATIONS` SET `NOM_TYPE` = ? WHERE `ID` = ?;")
						->execute(array(
							$typeChampsInformations->getNomType(),
							$typeChampsInformations->getId()
		));
	}

	public function delete(TypeChampsInformations $typeChampsInformations) {
		return $this->db->prepare("DELETE FROM `TYPE_CHAMPS_INFORMATIONS` WHERE `ID` = ?;")
						->execute(array($typeChampsInformations->getId()));
	}

}
