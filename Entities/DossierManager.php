<?php

// Manque insert
class DossierManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function findOneByFormation($ine, $codeFormation) {
		$rs = $this->db->prepare("SELECT * FROM `dossier` WHERE `dossier`.`INE` = ? AND `dossier`.`CODE_FORMATION` = ?;")
						->execute(array($ine, $codeFormation))->fetch();
		return new Dossier(
				$rs['INE'], $rs['CODE_FORMATION'], $rs['CODE'], $rs['NOM'], $rs['PRENOM'], $rs['ADRESSE'], $rs['COMPLEMENT'], $rs['CODE_POSTAL'], $rs['VILLE'], $rs['DATE_NAISSANCE'], $rs['LIEU_NAISSANCE'], $rs['FIXE'], $rs['PORTABLE'], $rs['MAIL'], $rs['LANGUES'], $rs['NATIONALITE'], $rs['ACTIVITE'], $rs['TITULAIRE'], $rs['INFORMATIONS'], $rs['DATE_DOSSIER']
		);
	}

	public function findAllByFormation($codeFormation) {
		$dossiers = array();
		$rs = $this->db->prepare("SELECT * FROM `dossier` WHERE `dossier`.`CODE_FORMATION` = ?;")->fetchAll()
						->execute(array($codeFormation))->fetchAll();
		foreach ($rs as $dossier) {
			$dossiers[] = new Dossier($dossier['INE'], $dossier['CODE_FORMATION'], $dossier['CODE'], $dossier['NOM'], $dossier['PRENOM'], $dossier['ADRESSE'], $dossier['COMPLEMENT'], $dossier['CODE_POSTAL'], $dossier['VILLE'], $dossier['DATE_NAISSANCE'], $dossier['LIEU_NAISSANCE'], $dossier['FIXE'], $dossier['PORTABLE'], $dossier['MAIL'], $dossier['LANGUES'], $dossier['NATIONALITE'], $dossier['ACTIVITE'], $dossier['TITULAIRE'], $dossier['INFORMATIONS'], $dossier['DATE_DOSSIER']);
		}
		return $dossiers;
	}

	public function insert(Dossier $dossier) {
		return $this->db->prepare("INSERT INTO `dossier` (`INE`, `CODE_FORMATION`, `CODE`, `NOM`, `PRENOM`, `ADRESSE`, `COMPLEMENT`, `CODE_POSTAL`, `VILLE`, `DATE_NAISSANCE`, `LIEU_NAISSANCE`, `FIXE`, `PORTABLE`, `MAIL`, `LANGUES`, `NATIONALITE`, `ACTIVITE`, `TITULAIRE`, `INFORMATIONS`, `DATE_DOSSIER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")
						->execute(array(
							$dossier->getIne(),
							$dossier->getCodeFormation(),
							$dossier->getCode(),
							$dossier->getNom(),
							$dossier->getPrenom(),
							$dossier->getAdresse(),
							$dossier->getComplement(),
							$dossier->getCode_postal(),
							$dossier->getVille(),
							$dossier->getDateNaissance(),
							$dossier->getLieuNaissance(),
							$dossier->getFixe(),
							$dossier->getPortable(),
							$dossier->getMail(),
							$dossier->getLangues(),
							$dossier->getNationalite(),
							$dossier->getActivite(),
							$dossier->getTitulaire(),
							$dossier->getInformations(),
							$dossier->getDateDossier()
		));
	}

	public function update(Dossier $dossier) {
		return $this->db->prepare("UPDATE `dossier` SET `CODE` = ?, `NOM` = ?, `PRENOM` = ?, `ADRESSE` = ?, `COMPLEMENT` = ?, `CODE_POSTAL` = ?, `VILLE` = ?, `DATE_NAISSANCE` = ?, `LIEU_NAISSANCE` = ?, `FIXE` = ?, `PORTABLE` = ?, `MAIL` = ?, `LANGUES` = ?, `NATIONALITE` = ?, `ACTIVITE` = ?, `TITULAIRE` = ?, `INFORMATIONS` = ?, `DATE_DOSSIER` = ? WHERE `INE` = ? AND `CODE_FORMATION` = ?;")
						->execute(array(
							$dossier->getCode(),
							$dossier->getNom(),
							$dossier->getPrenom(),
							$dossier->getAdresse(),
							$dossier->getComplement(),
							$dossier->getCode_postal(),
							$dossier->getVille(),
							$dossier->getDateNaissance(),
							$dossier->getLieuNaissance(),
							$dossier->getFixe(),
							$dossier->getPortable(),
							$dossier->getMail(),
							$dossier->getLangues(),
							$dossier->getNationalite(),
							$dossier->getActivite(),
							$dossier->getTitulaire(),
							$dossier->getInformations(),
							$dossier->getDateDossier(),
							$dossier->getIne(),
							$dossier->getCodeFormation()
		));
	}

	public function delete(Dossier $dossier) {
		return $this->db->prepare("DELETE FROM `dossier` WHERE `INE` = ? AND `CODE_FORMATION` = ?;")
						->execute(array(
							$dossier->getIne(),
							$dossier->getCodeFormation()
		));
	}

}
