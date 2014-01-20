<?php

class SeDeroulerManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findAll() {
		$lesSeDerouler = array();
		$rs = $this->db->query("SELECT * FROM `SE_DEROULER`;")->fetchAll();
		foreach ($rs as $unSeDerouler) {
			$lesSeDerouler[] = new SeDerouler($unSeDerouler['CODE_VET'], $unSeDerouler['CODE_ETAPE']);
		}
		return $lesSeDerouler;
	}

	public function insert(SeDerouler $SeDerouler) {
		return $this->db->prepare("INSERT INTO `SE_DEROULER` (`CODE_VET`, `CODE_ETAPE`) VALUES (?, ?);")
						->execute(array($SeDerouler->getCodeVet(), $SeDerouler->getCodeEtape()));
	}

	public function delete(SeDerouler $SeDerouler) {
		return $this->db->prepare("DELETE FROM `SE_DEROULER` WHERE `CODE_VET`= ? AND `CODE_ETAPE` = ?;")
						->execute(array($SeDerouler->getCodeVet(), $SeDerouler->getCodeEtape()));
	}

}
