<?php

class FaireManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findAllByDossier(Dossier $dossier) {
		$faires = array();
		$q = $this->db->prepare("SELECT * FROM `FAIRE` WHERE `INE` = ? AND `CODE_FORMATION` = ? ORDER BY `ORDRE`;");
        $q->execute(array($dossier->getIne(), $dossier->getCodeFormation()));
        $rs = $q->fetchAll();

		foreach ($rs as $faire) {
			$faires[] = new Faire($faire['CODE_ETAPE'], $faire['INE'], $faire['CODE_FORMATION'], $faire['ORDRE']);
		}
		return $faires;
	}

	public function insert(Faire $faire) {
		return $this->db->prepare("INSERT INTO `FAIRE` (`CODE_ETAPE`, `INE`, `CODE_FORMATION`, `ORDRE`) VALUES (?, ?, ?, ?);")
						->execute(array(
							$faire->getCodeEtape(),
							$faire->getIne(),
							$faire->getCodeFormation(),
							$faire->getOrdre()
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
