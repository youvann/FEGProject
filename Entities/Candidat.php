<?php

class Candidat {

	private $nom;
	private $prenom;
	private $numIne;
	private $email;
	private $numTel;
	private $lieuNaissance;
	private $dateNaissance;
	private $nationnalite;
	private $activiteEtudiante;
	private $codeEtape;
	private $codeVet;
	private $voeux1;
	private $voeux2;
	private $voeux3;
	private $urlDossierEtudiant;
	private $anneeBac;
	private $serieBac;
	private $etablissementBac;
	private $departementBac;
	private $paysBac;
	private $experienceProfessionnelle;
	private $jobEtudiant;
	private $emploie;
	private $langueEtrangere;
	private $autresElement;

	function __construct($nom, $prenom, $numIne, $email, $numTel, $lieuNaissance, $dateNaissance, $nationnalite, $activiteEtudiante, $codeEtape, $codeVet, $voeux1, $voeux2, $voeux3, $urlDossierEtudiant, $anneeBac, $serieBac, $etablissementBac, $departementBac, $paysBac, $experienceProfessionnelle, $jobEtudiant, $emploie, $langueEtrangere, $autresElement) {
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->numIne = $numIne;
		$this->email = $email;
		$this->numTel = $numTel;
		$this->lieuNaissance = $lieuNaissance;
		$this->dateNaissance = $dateNaissance;
		$this->nationnalite = $nationnalite;
		$this->activiteEtudiante = $activiteEtudiante;
		$this->codeEtape = $codeEtape;
		$this->codeVet = $codeVet;
		$this->voeux1 = $voeux1;
		$this->voeux2 = $voeux2;
		$this->voeux3 = $voeux3;
		$this->urlDossierEtudiant = $urlDossierEtudiant;
		$this->anneeBac = $anneeBac;
		$this->serieBac = $serieBac;
		$this->etablissementBac = $etablissementBac;
		$this->departementBac = $departementBac;
		$this->paysBac = $paysBac;
		$this->experienceProfessionnelle = $experienceProfessionnelle;
		$this->jobEtudiant = $jobEtudiant;
		$this->emploie = $emploie;
		$this->langueEtrangere = $langueEtrangere;
		$this->autresElement = $autresElement;
	}
	
	public function getNom() {
		return $this->nom;
	}

	public function getPrenom() {
		return $this->prenom;
	}

	public function getNumIne() {
		return $this->numIne;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getNumTel() {
		return $this->numTel;
	}

	public function getLieuNaissance() {
		return $this->lieuNaissance;
	}

	public function getDateNaissance() {
		return $this->dateNaissance;
	}

	public function getNationnalite() {
		return $this->nationnalite;
	}

	public function getActiviteEtudiante() {
		return $this->activiteEtudiante;
	}

	public function getCodeEtape() {
		return $this->codeEtape;
	}

	public function getCodeVet() {
		return $this->codeVet;
	}

	public function getVoeux1() {
		return $this->voeux1;
	}

	public function getVoeux2() {
		return $this->voeux2;
	}

	public function getVoeux3() {
		return $this->voeux3;
	}

	public function getUrlDossierEtudiant() {
		return $this->urlDossierEtudiant;
	}

	public function getAnneeBac() {
		return $this->anneeBac;
	}

	public function getSerieBac() {
		return $this->serieBac;
	}

	public function getEtablissementBac() {
		return $this->etablissementBac;
	}

	public function getDepartementBac() {
		return $this->departementBac;
	}

	public function getPaysBac() {
		return $this->paysBac;
	}

	public function getExperienceProfessionnelle() {
		return $this->experienceProfessionnelle;
	}

	public function getJobEtudiant() {
		return $this->jobEtudiant;
	}

	public function getEmploie() {
		return $this->emploie;
	}

	public function getLangueEtrangere() {
		return $this->langueEtrangere;
	}

	public function getAutresElement() {
		return $this->autresElement;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setPrenom($prenom) {
		$this->prenom = $prenom;
	}

	public function setNumIne($numIne) {
		$this->numIne = $numIne;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setNumTel($numTel) {
		$this->numTel = $numTel;
	}

	public function setLieuNaissance($lieuNaissance) {
		$this->lieuNaissance = $lieuNaissance;
	}

	public function setDateNaissance($dateNaissance) {
		$this->dateNaissance = $dateNaissance;
	}

	public function setNationnalite($nationnalite) {
		$this->nationnalite = $nationnalite;
	}

	public function setActiviteEtudiante($activiteEtudiante) {
		$this->activiteEtudiante = $activiteEtudiante;
	}

	public function setCodeEtape($codeEtape) {
		$this->codeEtape = $codeEtape;
	}

	public function setCodeVet($codeVet) {
		$this->codeVet = $codeVet;
	}

	public function setVoeux1($voeux1) {
		$this->voeux1 = $voeux1;
	}

	public function setVoeux2($voeux2) {
		$this->voeux2 = $voeux2;
	}

	public function setVoeux3($voeux3) {
		$this->voeux3 = $voeux3;
	}

	public function setUrlDossierEtudiant($urlDossierEtudiant) {
		$this->urlDossierEtudiant = $urlDossierEtudiant;
	}

	public function setAnneeBac($anneeBac) {
		$this->anneeBac = $anneeBac;
	}

	public function setSerieBac($serieBac) {
		$this->serieBac = $serieBac;
	}

	public function setEtablissementBac($etablissementBac) {
		$this->etablissementBac = $etablissementBac;
	}

	public function setDepartementBac($departementBac) {
		$this->departementBac = $departementBac;
	}

	public function setPaysBac($paysBac) {
		$this->paysBac = $paysBac;
	}

	public function setExperienceProfessionnelle($experienceProfessionnelle) {
		$this->experienceProfessionnelle = $experienceProfessionnelle;
	}

	public function setJobEtudiant($jobEtudiant) {
		$this->jobEtudiant = $jobEtudiant;
	}

	public function setEmploie($emploie) {
		$this->emploie = $emploie;
	}

	public function setLangueEtrangere($langueEtrangere) {
		$this->langueEtrangere = $langueEtrangere;
	}

	public function setAutresElement($autresElement) {
		$this->autresElement = $autresElement;
	}
}
