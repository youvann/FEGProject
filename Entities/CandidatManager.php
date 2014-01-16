<?php
// Manque insert
class CandidatManager {

	private $db;

	function __construct(PDO $db) {
		$this->setDb($db);
	}

	public function setDb(PDO $db) {
		$this->db = $db;
	}

	public function find($numIne, $codeEtape, $codeVet) {
		$rs = $this->db->prepare("SELECT * FROM `CANDIDAT` WHERE `NUM_INE` = ? AND `CODE_ETAPE` = ? AND `CODE_VET` = ?;")
						->execute(array($numIne, $codeEtape, $codeVet))->fetch();
		return new Candidat($rs['NOM'], $rs['PRENOM'], $rs['NUM_INE'], $rs['EMAIL'], $rs['NUM_TEL'], $rs['LIEU_NAISSANCE'], $rs['DATE_NAISSANCE'], $rs['NATIONNALITE'], $rs['ACTIVITE_ETUDIANTE'], $rs['CODE_ETAPE'], $rs['CODE_VET'], $rs['VOEUX1'], $rs['VOEUX2'], $rs['VOEUX3'], $rs['URL_DOSSIER_ETUDIANT'], $rs['ANNEE_BAC'], $rs['SERIE_BAC'], $rs['ETABLISSEMENT_BAC'], $rs['DEPARTEMENT_BAC'], $rs['PAYS_BAC'], $rs['EXPERIENCE_PROFESSIONNELLE'], $rs['JOB_ETUDIANT'], $rs['EMPLOIE'], $rs['LANGUE_ETRANGERE'], $rs['AUTRES_ELEMENT']);
	}

	// RAJOUTER select tous par formation

	public function findAll() {
		$candidats = array();
		$rs = $this->db->query("SELECT * FROM `CANDIDAT`;")->fetchAll();
		foreach ($rs as $candidat) {
			$candidats[] = new Candidat($candidat['NOM'], $candidat['PRENOM'], $candidat['NUM_INE'], $candidat['EMAIL'], $candidat['NUM_TEL'], $candidat['LIEU_NAISSANCE'], $candidat['DATE_NAISSANCE'], $candidat['NATIONNALITE'], $candidat['ACTIVITE_ETUDIANTE'], $candidat['CODE_ETAPE'], $candidat['CODE_VET'], $candidat['VOEUX1'], $candidat['VOEUX2'], $candidat['VOEUX3'], $candidat['URL_DOSSIER_ETUDIANT'], $candidat['ANNEE_BAC'], $candidat['SERIE_BAC'], $candidat['ETABLISSEMENT_BAC'], $rs['DEPARTEMENT_BAC'], $rs['PAYS_BAC'], $candidat['EXPERIENCE_PROFESSIONNELLE'], $candidat['JOB_ETUDIANT'], $candidat['EMPLOIE'], $candidat['LANGUE_ETRANGERE'], $candidat['AUTRES_ELEMENT']);
		}
		return $candidats;
	}

	public function insert(Candidat $candidat) {
		return $this->db->prepare("")
						->execute(array(
							$candidat->getNom(),
							$candidat->getPrenom(),
							$candidat->getNumIne(),
							$candidat->getEmail(),
							$candidat->getNumTel(),
							$candidat->getLieuNaissance(),
							$candidat->getDateNaissance(),
							$candidat->getNationnalite(),
							$candidat->getActiviteEtudiante(),
							$candidat->getCodeEtape(),
							$candidat->getCodeVet(),
							$candidat->getVoeux1(),
							$candidat->getVoeux2(),
							$candidat->getVoeux3(),
							$candidat->getUrlDossierEtudiant(),
							$candidat->getAnneeBac(),
							$candidat->getSerieBac(),
							$candidat->getEtablissementBac(),
							$candidat->getDepartementBac(),
							$candidat->getPaysBac(),
							$candidat->getExperienceProfessionnelle(),
							$candidat->getJobEtudiant(),
							$candidat->getEmploie(),
							$candidat->getLangueEtrangere(),
							$candidat->getAutresElement()
		));
	}

	public function delete(Candidat $candidat) {
		return $this->db->prepare("DELETE FROM `candidat` WHERE `NUM_INE` = ?` AND CODE_ETAPE` = ? AND `CODE_VET` = ? ;")
						->execute(array(
							$candidat->getNumIne(),
							$candidat->getCodeEtape(),
							$candidat->getCodeVet()
		));
	}
}
