<?php

class FaireManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find();

	public function insert(Faire $faire) {
		return $this->db->prepare("INSERT INTO `FAIRE` (`CODE_ETAPE`, `INE`, `CODE_FORMATION`, `ORDRE`) VALUES (?, ?, ?, ?);")
						->execute(array(
							$faire->CodeEtape(),
							$faire->Ine(),
							$faire->CodeFormation(),
							$faire->Ordre()
		));
	}

	public function delete(Faire $faire) {
		return $this->db->prepare("DELETE FROM `FAIRE` WHERE `CODE_ETAPE` = ? AND `INE` = ?;")
						->execute(array(
							$faire->CodeEtape(),
							$faire->Ine()
		));
	}

}
