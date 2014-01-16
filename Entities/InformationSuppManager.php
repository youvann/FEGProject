<?php
// CHECK
class InformationSuppManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($codeEtape, $codeVet, $id) {
		$rs = $this->db->prepare("SELECT * FROM `INFORMATION_SUPP` WHERE `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array($codeEtape, $codeVet, $id))->fetch();
		return new InformationSupp($rs['CODE_ETAPE'], $rs['CODE_VET'], $rs['ID'], $rs['LIBEL_INFORMATION'], $rs['REQUIS'], $rs['ID_TYPE_ELEMENT']);
	}

	// RAJOUTER SELECT pour une formation

	public function findAll() {
		$informationsSupp = array();
		$rs = $this->db->query("SELECT * FROM `INFORMATION_SUPP`;")->fetchAll();
		foreach ($rs as $informationSupp) {
			$informationsSupp[] = new InformationSupp($informationSupp['CODE_ETAPE'], $informationSupp['CODE_VET'], $informationSupp['ID'], $informationSupp['LIBEL_INFORMATION'], $informationSupp['REQUIS'], $informationSupp['ID_TYPE_ELEMENT']);
		}
		return $informationsSupp;
	}

	public function insert(InformationSupp $informationSupp) {
		return $this->db->prepare("INSERT INTO `INFORMATION_SUPP` (`CODE_ETAPE`, `CODE_VET`, `ID`, `LIBEL_INFORMATION`, `REQUIS`, `ID_TYPE_ELEMENT`) VALUES (?, ?, ?, ?, ?, ?);")
						->execute(array(
							$informationSupp->getCodeEtape(),
							$informationSupp->getCodeVet(),
							$informationSupp->getId(),
							$informationSupp->getLibelInformation(),
							$informationSupp->getRequis(),
							$informationSupp->getIdTypeElement()
		));
	}

	public function update(InformationSupp $informationSupp) {
		return $this->db->prepare("UPDATE `INFORMATION_SUPP` SET `LIBEL_INFORMATION` = ?, `REQUIS` = ?, WHERE `ID` = ?;")
						->execute(array(
							$informationSupp->getLibelInformation(),
							$informationSupp->getRequis(),
							$informationSupp->getId()
		));
	}

	public function delete(InformationSupp $informationSupp) {
		return $this->db->prepare("DELETE FROM `INFORMATION_SUPP` WHERE `ID` = ?;")
						->execute(array($informationSupp->getId()));
	}

}
