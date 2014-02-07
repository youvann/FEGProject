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
		$q = $this->db->prepare("SELECT * FROM `information` WHERE `ID` = ?;");
		$q->execute(array($id));
		$rs = $q->fetch();
		return new Information($rs['ID'], $rs['TYPE'], $rs['CODE_FORMATION'], $rs['LIBELLE'], $rs['EXPLICATIONS'], $rs['ORDRE']);
	}

	public function findAllByFormation(Formation $formation) {
		$informations = array();
		$q = $this->db->prepare("SELECT * FROM `information` WHERE `CODE_FORMATION` = ? ORDER BY `ORDRE`;");
		$q->execute(array($formation->getCodeFormation()));
		$rs = $q->fetchAll();
		foreach ($rs as $information) {
			$informations[] = new Information($information['ID'], $information['TYPE'], $information['CODE_FORMATION'], $information['LIBELLE'], $information['EXPLICATIONS'], $information['ORDRE']);
		}
		return $informations;
	}

	public function insert(Information $information) {
		$q = $this->db->prepare("SELECT (SELECT ifnull(max(`id`),'i00000')  FROM `information`) as id, (SELECT ifnull(max(`ordre`),'0') FROM `information` WHERE `information`.`code_formation` = ?) as ordre;");
		$q->execute(array($information->getCodeFormation()));
		$rs = $q->fetch();
		$id = $rs['id'];
		$ordre = $rs['ordre'];

		return $this->db->prepare("INSERT INTO `information` (`ID`, `TYPE`, `CODE_FORMATION`, `LIBELLE`, `EXPLICATIONS`, `ORDRE`) VALUES (?, ?, ?, ?, ?, ?);")
						->execute(array(
							++$id,
							$information->getType(),
							$information->getCodeFormation(),
							$information->getLibelle(),
							$information->getExplications(),
							++$ordre
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
		return $this->db->prepare("DELETE FROM `information` WHERE `ID` = ?;")
						->execute(array($information->getId()));
	}

	public function maxId() {
		$rs = $this->db->query("SELECT MAX(`ID`) as ID FROM `information`;")->fetch();
		return $rs['ID'];
	}

	public function getResultset(Formation $formation) {
		$q = $this->db->prepare('SELECT `information`.`ID` as idInfo, `information`.`LIBELLE` as libelleInfo, `type`.`ID` as typeInfo, `choix`.`TEXTE` as libellesInfo
			FROM `information` 
			INNER JOIN `type` ON (`information`.`type` = `type`.`id`)
			LEFT JOIN `choix` ON (`information`.`id` = `choix`.`information`)
			WHERE `information`.`code_formation` = ?
			ORDER BY `information`.`ordre`;');
		$q->execute(array($formation->getCodeFormation()));
		return $q->fetchAll();
	}

}
