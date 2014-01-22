<?php

class Dossier {

	private $ine;
	private $codeFormation;
	private $autre;
	private $nom;
	private $prenom;
	private $adresse;
	private $complement;
	private $codePostal;
	private $ville;
	private $dateNaissance;
	private $lieuNaissance;
	private $fixe;
	private $portable;
	private $mail;
	private $langues;
	private $nationalite;
	private $serieBac;
	private $anneeBac;
	private $etablissementBac;
	private $departementBac;
	private $paysBac;
	private $activite;
	private $titulaire;
	private $informations;
	private $dateDossier;

	function __construct($ine, $codeFormation, $autre, $nom, $prenom, $adresse, $complement, $codePostal, $ville, $dateNaissance, $lieuNaissance, $fixe, $portable, $mail, $langues, $nationalite, $serieBac, $anneeBac, $etablissementBac, $departementBac, $paysBac, $activite, $titulaire, $informations, $dateDossier) {
		$this->ine = $ine;
		$this->codeFormation = $codeFormation;
		$this->autre = $autre;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->adresse = $adresse;
		$this->complement = $complement;
		$this->codePostal = $codePostal;
		$this->ville = $ville;
		$this->dateNaissance = $dateNaissance;
		$this->lieuNaissance = $lieuNaissance;
		$this->fixe = $fixe;
		$this->portable = $portable;
		$this->mail = $mail;
		$this->langues = $langues;
		$this->nationalite = $nationalite;
		$this->serieBac = $serieBac;
		$this->anneeBac = $anneeBac;
		$this->etablissementBac = $etablissementBac;
		$this->departementBac = $departementBac;
		$this->paysBac = $paysBac;
		$this->activite = $activite;
		$this->titulaire = $titulaire;
		$this->informations = $informations;
		$this->dateDossier = $dateDossier;
	}

	public function getIne() {
		return $this->ine;
	}

	public function getCodeFormation() {
		return $this->codeFormation;
	}

	public function getAutre() {
		return $this->autre;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getPrenom() {
		return $this->prenom;
	}

	public function getAdresse() {
		return $this->adresse;
	}

	public function getComplement() {
		return $this->complement;
	}

	public function getCodePostal() {
		return $this->codePostal;
	}

	public function getVille() {
		return $this->ville;
	}

	public function getDateNaissance() {
		return $this->dateNaissance;
	}

	public function getLieuNaissance() {
		return $this->lieuNaissance;
	}

	public function getFixe() {
		return $this->fixe;
	}

	public function getPortable() {
		return $this->portable;
	}

	public function getMail() {
		return $this->mail;
	}

	public function getLangues() {
		return $this->langues;
	}

	public function getNationalite() {
		return $this->nationalite;
	}

	public function getSerieBac() {
		return $this->serieBac;
	}

	public function getAnneeBac() {
		return $this->anneeBac;
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

	public function getActivite() {
		return $this->activite;
	}

	public function getTitulaire() {
		return $this->titulaire;
	}

	public function getInformations() {
		return $this->informations;
	}

	public function getDateDossier() {
		return $this->dateDossier;
	}

	public function setIne($ine) {
		$this->ine = $ine;
	}

	public function setCodeFormation($codeFormation) {
		$this->codeFormation = $codeFormation;
	}

	public function setAutre($autre) {
		$this->autre = $autre;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setPrenom($prenom) {
		$this->prenom = $prenom;
	}

	public function setAdresse($adresse) {
		$this->adresse = $adresse;
	}

	public function setComplement($complement) {
		$this->complement = $complement;
	}

	public function setCodePostal($codePostal) {
		$this->codePostal = $codePostal;
	}

	public function setVille($ville) {
		$this->ville = $ville;
	}

	public function setDateNaissance($dateNaissance) {
		$this->dateNaissance = $dateNaissance;
	}

	public function setLieuNaissance($lieuNaissance) {
		$this->lieuNaissance = $lieuNaissance;
	}

	public function setFixe($fixe) {
		$this->fixe = $fixe;
	}

	public function setPortable($portable) {
		$this->portable = $portable;
	}

	public function setMail($mail) {
		$this->mail = $mail;
	}

	public function setLangues($langues) {
		$this->langues = $langues;
	}

	public function setNationalite($nationalite) {
		$this->nationalite = $nationalite;
	}

	public function setSerieBac($serieBac) {
		$this->serieBac = $serieBac;
	}

	public function setAnneeBac($anneeBac) {
		$this->anneeBac = $anneeBac;
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

	public function setActivite($activite) {
		$this->activite = $activite;
	}

	public function setTitulaire($titulaire) {
		$this->titulaire = $titulaire;
	}

	public function setInformations($informations) {
		$this->informations = $informations;
	}

	public function setDateDossier($dateDossier) {
		$this->dateDossier = $dateDossier;
	}


}
