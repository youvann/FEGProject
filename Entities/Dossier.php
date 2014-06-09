<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Dossier.php
 * @Purpose: Entité Dossier
 * @Author: Lionel Guissani
 */
class Dossier {
	/**
	 * @var string Identifiant de l'étudiant
	 */
	private $idEtudiant;
	/**
	 * @var string Numéro INE
	 */
    private $ine;
	/**
	 * @var string Sexe
	 */
	private $genre;
	/**
	 * @var string Code formation
	 */
    private $codeFormation;
	/**
	 * @var string Autre
	 */
	private $autre;
	/**
	 * @var string Nom
	 */
    private $nom;
	/**
	 * @var string Prénom
	 */
    private $prenom;
	/**
	 * @var string Adresse
	 */
    private $adresse;
	/**
	 * @var string Complément d'adresse
	 */
    private $complement;
	/**
	 * @var string Code postal
	 */
    private $codePostal;
	/**
	 * @var string Ville de résidence
	 */
    private $ville;
	/**
	 * @var string Date de naissance
	 */
    private $dateNaissance;
	/**
	 * @var string Lieu de naissance
	 */
    private $lieuNaissance;
	/**
	 * @var string Téléphone fixe
	 */
    private $fixe;
	/**
	 * @var string Téléphone portable
	 */
    private $portable;
	/**
	 * @var string Adresse mail
	 */
    private $mail;
	/**
	 * @var string Langues parlées
	 */
    private $langues;
	/**
	 * @var string Nationalité
	 */
    private $nationalite;
	/**
	 * @var string Série BAC
	 */
    private $serieBac;
	/**
	 * @var string Année d'obtention du BAC
	 */
    private $anneeBac;
	/**
	 * @var string Etablissement où a été obtenu le BAC
	 */
    private $etablissementBac;
	/**
	 * @var string Département où a été obtenu le BAC
	 */
    private $departementBac;
	/**
	 * @var string Pays ou a été obtenu le BAC
	 */
    private $paysBac;
	/**
	 * @var string Activité
	 */
    private $activite;
	/**
	 * @var string Titulaire
	 */
    private $titulaire;
	/**
	 * @var string Ville préférée
	 */
    private $villePreferee;
	/**
	 * @var string Autres éléments
	 */
    private $autresElements;
	/**
	 * @var string Informations au format JSON
	 */
    private $informations;
    private $type;

	/**
	 * Contructeur
	 * @param $idEtudiant string Identifiant de l'étudiant
	 * @param $ine string Numéro INE
	 * @param $genre string Sexe
	 * @param $codeFormation string Code formation
	 * @param $autre string Autre
	 * @param $nom string Nom
	 * @param $prenom string Prénom
	 * @param $adresse string Adresse
	 * @param $complement string Complément d'adresse
	 * @param $codePostal string Code postal
	 * @param $ville string Ville de résidence
	 * @param $dateNaissance string Date de naissance
	 * @param $lieuNaissance string Lieu de naissance
	 * @param $fixe string Téléphone fixe
	 * @param $portable string Téléphone portable
	 * @param $mail string Adresse mail
	 * @param $langues string Langues parlées
	 * @param $nationalite string Nationalité
	 * @param $serieBac string Série BAC
	 * @param $anneeBac string Année d'obtention du BAC
	 * @param $etablissementBac string Etablissement où a été obtenu le BAC
	 * @param $departementBac string Département où a été obtenu le BAC
	 * @param $paysBac string Pays ou a été obtenu le BAC
	 * @param $activite string Activité
	 * @param $titulaire string Titulaire
	 * @param $villePreferee string Ville préférée
	 * @param $autresElements string Autres éléments
	 * @param $informations string Informations au format JSON
	 */
	public function __construct($idEtudiant, $ine, $genre, $codeFormation, $autre, $nom, $prenom, $adresse, $complement, $codePostal, $ville, $dateNaissance, $lieuNaissance, $fixe, $portable, $mail, $langues, $nationalite, $serieBac, $anneeBac, $etablissementBac, $departementBac, $paysBac, $activite, $titulaire, $villePreferee, $autresElements, $informations, $type) {
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
        $this->type = $type;
    }

	/**
	 * @param string $activite
	 */
	public function setActivite($activite)
	{
		$this->activite = $activite;
	}

	/**
	 * @return string
	 */
	public function getActivite()
	{
		return $this->activite;
	}

	/**
	 * @param string $adresse
	 */
	public function setAdresse($adresse)
	{
		$this->adresse = $adresse;
	}

	/**
	 * @return string
	 */
	public function getAdresse()
	{
		return $this->adresse;
	}

	/**
	 * @param string $anneeBac
	 */
	public function setAnneeBac($anneeBac)
	{
		$this->anneeBac = $anneeBac;
	}

	/**
	 * @return string
	 */
	public function getAnneeBac()
	{
		return $this->anneeBac;
	}

	/**
	 * @param string $autre
	 */
	public function setAutre($autre)
	{
		$this->autre = $autre;
	}

	/**
	 * @return string
	 */
	public function getAutre()
	{
		return $this->autre;
	}

	/**
	 * @param string $autresElements
	 */
	public function setAutresElements($autresElements)
	{
		$this->autresElements = $autresElements;
	}

	/**
	 * @return string
	 */
	public function getAutresElements()
	{
		return $this->autresElements;
	}

	/**
	 * @param string $codeFormation
	 */
	public function setCodeFormation($codeFormation)
	{
		$this->codeFormation = $codeFormation;
	}

	/**
	 * @return string
	 */
	public function getCodeFormation()
	{
		return $this->codeFormation;
	}

	/**
	 * @param string $codePostal
	 */
	public function setCodePostal($codePostal)
	{
		$this->codePostal = $codePostal;
	}

	/**
	 * @return string
	 */
	public function getCodePostal()
	{
		return $this->codePostal;
	}

	/**
	 * @param string $complement
	 */
	public function setComplement($complement)
	{
		$this->complement = $complement;
	}

	/**
	 * @return string
	 */
	public function getComplement()
	{
		return $this->complement;
	}

	/**
	 * @param string $dateNaissance
	 */
	public function setDateNaissance($dateNaissance)
	{
		$this->dateNaissance = $dateNaissance;
	}

	/**
	 * @return string
	 */
	public function getDateNaissance()
	{
		return $this->dateNaissance;
	}

	/**
	 * @param string $departementBac
	 */
	public function setDepartementBac($departementBac)
	{
		$this->departementBac = $departementBac;
	}

	/**
	 * @return string
	 */
	public function getDepartementBac()
	{
		return $this->departementBac;
	}

	/**
	 * @param string $etablissementBac
	 */
	public function setEtablissementBac($etablissementBac)
	{
		$this->etablissementBac = $etablissementBac;
	}

	/**
	 * @return string
	 */
	public function getEtablissementBac()
	{
		return $this->etablissementBac;
	}

	/**
	 * @param string $fixe
	 */
	public function setFixe($fixe)
	{
		$this->fixe = $fixe;
	}

	/**
	 * @return string
	 */
	public function getFixe()
	{
		return $this->fixe;
	}

	/**
	 * @param string $genre
	 */
	public function setGenre($genre)
	{
		$this->genre = $genre;
	}

	/**
	 * @return string
	 */
	public function getGenre()
	{
		return $this->genre;
	}

	/**
	 * @param string $idEtudiant
	 */
	public function setIdEtudiant($idEtudiant)
	{
		$this->idEtudiant = $idEtudiant;
	}

	/**
	 * @return string
	 */
	public function getIdEtudiant()
	{
		return $this->idEtudiant;
	}

	/**
	 * @param string $ine
	 */
	public function setIne($ine)
	{
		$this->ine = $ine;
	}

	/**
	 * @return string
	 */
	public function getIne()
	{
		return $this->ine;
	}

	/**
	 * @param string $informations
	 */
	public function setInformations($informations)
	{
		$this->informations = $informations;
	}

	/**
	 * @return string
	 */
	public function getInformations()
	{
		return $this->informations;
	}

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

	/**
	 * @param string $langues
	 */
	public function setLangues($langues)
	{
		$this->langues = $langues;
	}

	/**
	 * @return string
	 */
	public function getLangues()
	{
		return $this->langues;
	}

	/**
	 * @param string $lieuNaissance
	 */
	public function setLieuNaissance($lieuNaissance)
	{
		$this->lieuNaissance = $lieuNaissance;
	}

	/**
	 * @return string
	 */
	public function getLieuNaissance()
	{
		return $this->lieuNaissance;
	}

	/**
	 * @param string $mail
	 */
	public function setMail($mail)
	{
		$this->mail = $mail;
	}

	/**
	 * @return string
	 */
	public function getMail()
	{
		return $this->mail;
	}

	/**
	 * @param string $nationalite
	 */
	public function setNationalite($nationalite)
	{
		$this->nationalite = $nationalite;
	}

	/**
	 * @return string
	 */
	public function getNationalite()
	{
		return $this->nationalite;
	}

	/**
	 * @param string $nom
	 */
	public function setNom($nom)
	{
		$this->nom = $nom;
	}

	/**
	 * @return string
	 */
	public function getNom()
	{
		return $this->nom;
	}

	/**
	 * @param string $paysBac
	 */
	public function setPaysBac($paysBac)
	{
		$this->paysBac = $paysBac;
	}

	/**
	 * @return string
	 */
	public function getPaysBac()
	{
		return $this->paysBac;
	}

	/**
	 * @param string $portable
	 */
	public function setPortable($portable)
	{
		$this->portable = $portable;
	}

	/**
	 * @return string
	 */
	public function getPortable()
	{
		return $this->portable;
	}

	/**
	 * @param string $prenom
	 */
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;
	}

	/**
	 * @return string
	 */
	public function getPrenom()
	{
		return $this->prenom;
	}

	/**
	 * @param string $serieBac
	 */
	public function setSerieBac($serieBac)
	{
		$this->serieBac = $serieBac;
	}

	/**
	 * @return string
	 */
	public function getSerieBac()
	{
		return $this->serieBac;
	}

	/**
	 * @param string $titulaire
	 */
	public function setTitulaire($titulaire)
	{
		$this->titulaire = $titulaire;
	}

	/**
	 * @return string
	 */
	public function getTitulaire()
	{
		return $this->titulaire;
	}

	/**
	 * @param string $ville
	 */
	public function setVille($ville)
	{
		$this->ville = $ville;
	}

	/**
	 * @return string
	 */
	public function getVille()
	{
		return $this->ville;
	}

	/**
	 * @param string $villePreferee
	 */
	public function setVillePreferee($villePreferee)
	{
		$this->villePreferee = $villePreferee;
	}

	/**
	 * @return string
	 */
	public function getVillePreferee()
	{
		return $this->villePreferee;
	}
}
