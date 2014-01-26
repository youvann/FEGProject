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

	public function find($ine, $codeFormation) {
		$q = $this->db->prepare("SELECT * FROM `DOSSIER` WHERE `INE` = ? AND `CODE_FORMATION` = ?;");
		$q->execute(array($ine, $codeFormation));
		$rs = $q->fetch();
		return new Dossier($rs['INE'], $rs['CODE_FORMATION'], $rs['NOM'], $rs['PRENOM'], $rs['ADRESSE'], $rs['COMPLEMENT'], $rs['CODE_POSTAL'], $rs['VILLE'], $rs['DATE_NAISSANCE'], $rs['LIEU_NAISSANCE'], $rs['FIXE'], $rs['PORTABLE'], $rs['MAIL'], $rs['GENRE'], $rs['LANGUES'], $rs['NATIONALITE'], $rs['SERIE_BAC'], $rs['ANNEE_BAC'], $rs['ETABLISSEMENT_BAC'], $rs['DEPARTEMENT_BAC'], $rs['PAYS_BAC'], $rs['ACTIVITE'], $rs['AUTRE'], $rs['TITULAIRE'], $rs['VILLE_PREFEREE'], $rs['AUTRES_ELEMENTS'], $rs['INFORMATIONS'], $rs['DATE_DOSSIER']);
	}

	public function findAllByFormation($codeFormation) {
		$dossiers = array();
		$q = $this->db->prepare("SELECT * FROM `DOSSIER` WHERE `CODE_FORMATION` = ?;");
		$q->execute(array($codeFormation));
		$rs = $rs = $q->fetchAll();
		foreach ($rs as $dossier) {
			$dossiers[] = new Dossier($dossier['INE'], $dossier['CODE_FORMATION'], $dossier['AUTRE'], $dossier['NOM'], $dossier['PRENOM'], $dossier['ADRESSE'], $dossier['COMPLEMENT'], $dossier['CODE_POSTAL'], $dossier['VILLE'], $dossier['DATE_NAISSANCE'], $dossier['LIEU_NAISSANCE'], $dossier['FIXE'], $dossier['PORTABLE'], $dossier['MAIL'], $dossier['LANGUES'], $dossier['NATIONALITE'], $dossier['SERIE_BAC'], $dossier['ANNEE_BAC'], $dossier['ETABLISSEMENT_BAC'], $dossier['DEPARTEMENT_BAC'], $dossier['PAYS_BAC'], $dossier['ACTIVITE'], $dossier['TITULAIRE'], $dossier['AUTRES_ELEMENTS'], $dossier['INFORMATIONS'], $dossier['DATE_DOSSIER']);
		}
		return $dossiers;
	}

	public function insert(Dossier $dossier) {
		return $this->db->prepare("INSERT INTO `dossier` (`INE`, `CODE_FORMATION`, `NOM`, `PRENOM`, `ADRESSE`, `COMPLEMENT`, `CODE_POSTAL`, `VILLE`, `DATE_NAISSANCE`, `LIEU_NAISSANCE`, `FIXE`, `PORTABLE`, `MAIL`, `GENRE`, `LANGUES`, `NATIONALITE`, `SERIE_BAC`, `ANNEE_BAC`, `ETABLISSEMENT_BAC`, `DEPARTEMENT_BAC`, `PAYS_BAC`, `ACTIVITE`, `AUTRE`, `TITULAIRE`, `VILLE_PREFEREE`, `AUTRES_ELEMENTS`, `INFORMATIONS`, `COMPLET`, `DATE_DOSSIER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW());")
						->execute(array(
							$dossier->getIne(),
							$dossier->getCodeFormation(),
							$dossier->getNom(),
							$dossier->getPrenom(),
							$dossier->getAdresse(),
							$dossier->getComplement(),
							$dossier->getCodePostal(),
							$dossier->getVille(),
							$dossier->getDateNaissance(),
							$dossier->getLieuNaissance(),
							$dossier->getFixe(),
							$dossier->getPortable(),
							$dossier->getMail(),
							$dossier->getGenre(),
							$dossier->getLangues(),
							$dossier->getNationalite(),
							$dossier->getSerieBac(),
							$dossier->getAnneeBac(),
							$dossier->getEtablissementBac(),
							$dossier->getDepartementBac(),
							$dossier->getPaysBac(),
							$dossier->getActivite(),
							$dossier->getAutre(),
							$dossier->getTitulaire(),
							$dossier->getVillePreferee(),
							$dossier->getAutresElements(),
							$dossier->getInformations(),
							$dossier->getDateDossier()
		));
	}

	public function update(Dossier $dossier) {
		return $this->db->prepare("UPDATE `dossier` SET `NOM` = ?, `PRENOM` = ?, `ADRESSE` = ?, `COMPLEMENT` = ?, `CODE_POSTAL` = ?, `VILLE` = ?, `DATE_NAISSANCE` = ?, `LIEU_NAISSANCE` = ?, `FIXE` = ?, `PORTABLE` = ?, `MAIL` = ?, `GENRE` = ?, `LANGUES` = ?, `NATIONALITE` = ?, `SERIE_BAC` = ?, `ANNEE_BAC` = ?, `ETABLISSEMENT_BAC` = ?, `DEPARTEMENT_BAC` = ?, `PAYS_BAC` = ?, `ACTIVITE` = ?, `AUTRE` = ?, `TITULAIRE` = ?, `VILLE_PREFEREE` = ?, `AUTRES_ELEMENTS` = ?, `INFORMATIONS` = ?, `COMPLET` = ?, `DATE_DOSSIER` = ? WHERE `INE` = ? AND `CODE_FORMATION` = ?;")
						->execute(array(
							$dossier->getNom(),
							$dossier->getPrenom(),
							$dossier->getAdresse(),
							$dossier->getComplement(),
							$dossier->getCodePostal(),
							$dossier->getVille(),
							$dossier->getDateNaissance(),
							$dossier->getLieuNaissance(),
							$dossier->getFixe(),
							$dossier->getPortable(),
							$dossier->getMail(),
							$dossier->getGenre(),
							$dossier->getLangues(),
							$dossier->getNationalite(),
							$dossier->getSerieBac(),
							$dossier->getAnneeBac(),
							$dossier->getEtablissementBac(),
							$dossier->getDepartementBac(),
							$dossier->getPaysBac(),
							$dossier->getActivite(),
							$dossier->getAutre(),
							$dossier->getTitulaire(),
							$dossier->getVillePreferee(),
							$dossier->getAutresElements(),
							$dossier->getInformations(),
							$dossier->getDateDossier(),
							$dossier->getIne(),
							$dossier->getCodeFormation()
		));
	}

	public function delete(Dossier $dossier) {
		return $this->db->prepare("DELETE FROM `DOSSIER` WHERE `INE` = ? AND `CODE_FORMATION` = ?;")
						->execute(array(
							$dossier->getIne(),
							$dossier->getCodeFormation()
		));
	}

}
