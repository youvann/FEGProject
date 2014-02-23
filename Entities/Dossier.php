<?php

class Dossier {

	private $idEtudiant;
    private $ine;
	private $genre;
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
    private $villePreferee;
    private $autresElements;
    private $informations;

	public function __construct($idEtudiant, $ine, $genre, $codeFormation, $autre, $nom, $prenom, $adresse, $complement, $codePostal, $ville, $dateNaissance, $lieuNaissance, $fixe, $portable, $mail, $langues, $nationalite, $serieBac, $anneeBac, $etablissementBac, $departementBac, $paysBac, $activite, $titulaire, $villePreferee, $autresElements, $informations) {
        $this->idEtudiant = $idEtudiant;
        $this->ine = $ine;
        $this->genre = $genre;
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
        $this->villePreferee = $villePreferee;
        $this->autresElements = $autresElements;
        $this->informations = $informations;
    }

	/**
	 * @param mixed $activite
	 */
	public function setActivite($activite)
	{
		$this->activite = $activite;
	}

	/**
	 * @return mixed
	 */
	public function getActivite()
	{
		return $this->activite;
	}

	/**
	 * @param mixed $adresse
	 */
	public function setAdresse($adresse)
	{
		$this->adresse = $adresse;
	}

	/**
	 * @return mixed
	 */
	public function getAdresse()
	{
		return $this->adresse;
	}

	/**
	 * @param mixed $anneeBac
	 */
	public function setAnneeBac($anneeBac)
	{
		$this->anneeBac = $anneeBac;
	}

	/**
	 * @return mixed
	 */
	public function getAnneeBac()
	{
		return $this->anneeBac;
	}

	/**
	 * @param mixed $autre
	 */
	public function setAutre($autre)
	{
		$this->autre = $autre;
	}

	/**
	 * @return mixed
	 */
	public function getAutre()
	{
		return $this->autre;
	}

	/**
	 * @param mixed $autresElements
	 */
	public function setAutresElements($autresElements)
	{
		$this->autresElements = $autresElements;
	}

	/**
	 * @return mixed
	 */
	public function getAutresElements()
	{
		return $this->autresElements;
	}

	/**
	 * @param mixed $codeFormation
	 */
	public function setCodeFormation($codeFormation)
	{
		$this->codeFormation = $codeFormation;
	}

	/**
	 * @return mixed
	 */
	public function getCodeFormation()
	{
		return $this->codeFormation;
	}

	/**
	 * @param mixed $codePostal
	 */
	public function setCodePostal($codePostal)
	{
		$this->codePostal = $codePostal;
	}

	/**
	 * @return mixed
	 */
	public function getCodePostal()
	{
		return $this->codePostal;
	}

	/**
	 * @param mixed $complement
	 */
	public function setComplement($complement)
	{
		$this->complement = $complement;
	}

	/**
	 * @return mixed
	 */
	public function getComplement()
	{
		return $this->complement;
	}

	/**
	 * @param mixed $dateNaissance
	 */
	public function setDateNaissance($dateNaissance)
	{
		$this->dateNaissance = $dateNaissance;
	}

	/**
	 * @return mixed
	 */
	public function getDateNaissance()
	{
		return $this->dateNaissance;
	}

	/**
	 * @param mixed $departementBac
	 */
	public function setDepartementBac($departementBac)
	{
		$this->departementBac = $departementBac;
	}

	/**
	 * @return mixed
	 */
	public function getDepartementBac()
	{
		return $this->departementBac;
	}

	/**
	 * @param mixed $etablissementBac
	 */
	public function setEtablissementBac($etablissementBac)
	{
		$this->etablissementBac = $etablissementBac;
	}

	/**
	 * @return mixed
	 */
	public function getEtablissementBac()
	{
		return $this->etablissementBac;
	}

	/**
	 * @param mixed $fixe
	 */
	public function setFixe($fixe)
	{
		$this->fixe = $fixe;
	}

	/**
	 * @return mixed
	 */
	public function getFixe()
	{
		return $this->fixe;
	}

	/**
	 * @param mixed $genre
	 */
	public function setGenre($genre)
	{
		$this->genre = $genre;
	}

	/**
	 * @return mixed
	 */
	public function getGenre()
	{
		return $this->genre;
	}

	/**
	 * @param mixed $idEtudiant
	 */
	public function setIdEtudiant($idEtudiant)
	{
		$this->idEtudiant = $idEtudiant;
	}

	/**
	 * @return mixed
	 */
	public function getIdEtudiant()
	{
		return $this->idEtudiant;
	}

	/**
	 * @param mixed $ine
	 */
	public function setIne($ine)
	{
		$this->ine = $ine;
	}

	/**
	 * @return mixed
	 */
	public function getIne()
	{
		return $this->ine;
	}

	/**
	 * @param mixed $informations
	 */
	public function setInformations($informations)
	{
		$this->informations = $informations;
	}

	/**
	 * @return mixed
	 */
	public function getInformations()
	{
		return $this->informations;
	}

	/**
	 * @param mixed $langues
	 */
	public function setLangues($langues)
	{
		$this->langues = $langues;
	}

	/**
	 * @return mixed
	 */
	public function getLangues()
	{
		return $this->langues;
	}

	/**
	 * @param mixed $lieuNaissance
	 */
	public function setLieuNaissance($lieuNaissance)
	{
		$this->lieuNaissance = $lieuNaissance;
	}

	/**
	 * @return mixed
	 */
	public function getLieuNaissance()
	{
		return $this->lieuNaissance;
	}

	/**
	 * @param mixed $mail
	 */
	public function setMail($mail)
	{
		$this->mail = $mail;
	}

	/**
	 * @return mixed
	 */
	public function getMail()
	{
		return $this->mail;
	}

	/**
	 * @param mixed $nationalite
	 */
	public function setNationalite($nationalite)
	{
		$this->nationalite = $nationalite;
	}

	/**
	 * @return mixed
	 */
	public function getNationalite()
	{
		return $this->nationalite;
	}

	/**
	 * @param mixed $nom
	 */
	public function setNom($nom)
	{
		$this->nom = $nom;
	}

	/**
	 * @return mixed
	 */
	public function getNom()
	{
		return $this->nom;
	}

	/**
	 * @param mixed $paysBac
	 */
	public function setPaysBac($paysBac)
	{
		$this->paysBac = $paysBac;
	}

	/**
	 * @return mixed
	 */
	public function getPaysBac()
	{
		return $this->paysBac;
	}

	/**
	 * @param mixed $portable
	 */
	public function setPortable($portable)
	{
		$this->portable = $portable;
	}

	/**
	 * @return mixed
	 */
	public function getPortable()
	{
		return $this->portable;
	}

	/**
	 * @param mixed $prenom
	 */
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;
	}

	/**
	 * @return mixed
	 */
	public function getPrenom()
	{
		return $this->prenom;
	}

	/**
	 * @param mixed $serieBac
	 */
	public function setSerieBac($serieBac)
	{
		$this->serieBac = $serieBac;
	}

	/**
	 * @return mixed
	 */
	public function getSerieBac()
	{
		return $this->serieBac;
	}

	/**
	 * @param mixed $titulaire
	 */
	public function setTitulaire($titulaire)
	{
		$this->titulaire = $titulaire;
	}

	/**
	 * @return mixed
	 */
	public function getTitulaire()
	{
		return $this->titulaire;
	}

	/**
	 * @param mixed $ville
	 */
	public function setVille($ville)
	{
		$this->ville = $ville;
	}

	/**
	 * @return mixed
	 */
	public function getVille()
	{
		return $this->ville;
	}

	/**
	 * @param mixed $villePreferee
	 */
	public function setVillePreferee($villePreferee)
	{
		$this->villePreferee = $villePreferee;
	}

	/**
	 * @return mixed
	 */
	public function getVillePreferee()
	{
		return $this->villePreferee;
	}


}
