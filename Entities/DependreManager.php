<?php

class DependreManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findEtapes(DossierPdf $dossierPdf) {
		$dependances = array();
		$q = $this->db->prepare("SELECT * FROM `dependre` WHERE `ID_DOSSIER` = ?;");
		$q->execute(array($dossierPdf->getId()));
		$rs = $q->fetchAll();

		foreach ($rs as $dependance) {
			$dependances[] = new Dependre($dependance['ID_DOSSIER'], $dependance['CODE_ETAPE']);
		}
		return $dependances;
	}

	public function insert(Dependre $dependre) {
		return $this->db->prepare("INSERT INTO `dependre` (`ID_DOSSIER`, `CODE_ETAPE`) VALUES (?, ?);")
			->execute(array($dependre->getIdDossier(), $dependre->getCodeEtape()));
	}

	public function delete(Dependre $dependre) {
		return $this->db->prepare("DELETE FROM `dependre` WHERE `ID_DOSSIER` = ? AND `CODE_ETAPE` = ?;")
			->execute(array($dependre->getIdDossier(), $dependre->getCodeEtape()));
	}
}
