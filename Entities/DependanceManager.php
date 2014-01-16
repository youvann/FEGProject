<?php

class DependanceManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	// findByFormation

	public function findAll() {
		$dependances = array();
		$rs = $this->db->query("SELECT * FROM `DEPENDANCE`;")->fetchAll();
		foreach ($rs as $dependance) {
			$dependances[] = new Dependance($dependance['CODE_ETAPE_MERE'], $dependance['CODE_VET_MERE'], $dependance['CODE_ETAPE_FILLE'], $dependance['CODE_VET_FILLE']);
		}
		return $dependances;
	}

	public function insert(Dependance $dependance) {
		return $this->db->prepare("INSERT INTO `DEPENDANCE` (`CODE_ETAPE_MERE`, `CODE_VET_MERE`, `CODE_ETAPE_FILLE`, `CODE_VET_FILLE`) VALUES (?, ?, ?, ?);")
						->execute(array(
							$dependance->getCodeEtapeMere(),
							$dependance->getCodeVetMere(),
							$dependance->getCodeEtapeFille(),
							$dependance->getCodeVetFille()
		));
	}

	public function delete(Dependance $dependance) {
		return $this->db->prepare("DELETE FROM `DEPENDANCE` WHERE `CODE_ETAPE_MERE` = ? AND `CODE_VET_MERE` = ? AND `CODE_ETAPE_FILLE` = ? AND `CODE_VET_FILLE` = ?;")
						->execute(array(
							$dependance->getCodeEtapeMere(),
							$dependance->getCodeVetMere(),
							$dependance->getCodeEtapeFille(),
							$dependance->getCodeVetFille()
		));
	}

}
