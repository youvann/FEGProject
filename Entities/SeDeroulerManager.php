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
		$rs = $this->db->query("SELECT * FROM `se_derouler`;")->fetchAll();
		foreach ($rs as $unSeDerouler) {
			$lesSeDerouler[] = new SeDerouler($unSeDerouler['ID'], $unSeDerouler['CODE_ETAPE'], $unSeDerouler['RESPONSABLE'], $unSeDerouler['MAIL_RESPONSABLE']);
		}
		return $lesSeDerouler;
	}
	
	public function findAllByVoeu(Voeu $voeu) {
		$lesSeDerouler = array();
		$q = $this->db->prepare("SELECT * FROM `se_derouler` WHERE `CODE_ETAPE` = ?;");
		$q->execute(array($voeu->getCodeEtape()));
		$rs = $q->fetchAll();
		foreach ($rs as $unSeDerouler) {
			$lesSeDerouler[] = new SeDerouler($unSeDerouler['ID'], $unSeDerouler['CODE_ETAPE'], $unSeDerouler['RESPONSABLE'], $unSeDerouler['MAIL_RESPONSABLE']);
		}
		return $lesSeDerouler;
	}

	public function insert(SeDerouler $SeDerouler) {
		return $this->db->prepare("INSERT INTO `se_derouler` (`ID`, `CODE_ETAPE`, `RESPONSABLE`, `MAIL_RESPONSABLE`) VALUES (?, ?, ?, ?);")
						->execute(array($SeDerouler->getId(), $SeDerouler->getCodeEtape(), $SeDerouler->getResponsable(), $SeDerouler->getMailResponsable()));
	}

	public function delete(SeDerouler $SeDerouler) {
		return $this->db->prepare("DELETE FROM `se_derouler` WHERE `ID`= ? AND `CODE_ETAPE` = ?;")
						->execute(array($SeDerouler->getId(), $SeDerouler->getCodeEtape()));
	}

}
