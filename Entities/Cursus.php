<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Cursus.php
 * @Purpose: Entité Cursus
 * @Author: Lionel Guissani
 */
class Cursus {
	/**
	 * @var string Identitiant
	 */
	private $id;
	/**
	 * @var string Identifiant de l'étudiant
	 */
	private $idEtudiant;
	/**
	 * @var string Code formation
	 */
	private $codeFormation;
	/**
	 * @var string Année de début
	 */
	private $anneeDebut;
	/**
	 * @var string Année de fin
	 */
	private $anneeFin;
	/**
	 * @var string Cursus suivi
	 */
	private $cursus;
	/**
	 * @var string Etablissement
	 */
	private $etablissement;
	/**
	 * @var string Note
	 */
	private $note;
	/**
	 * @var string Valide
	 */
	private $valide;

	/**
	 * Constructeur
	 * @param $id string Identifiant
	 * @param $idEtudiant string Identifiant de l'étudiant
	 * @param $codeFormation string Code formation
	 * @param $anneeDebut string Année de début
	 * @param $anneeFin string Année de fin
	 * @param $cursus string Cursus
	 * @param $etablissement string Etablissement
	 * @param $note string Note
	 * @param $valide string Valide
	 */
	function __construct($id, $idEtudiant, $codeFormation, $anneeDebut, $anneeFin, $cursus, $etablissement, $note, $valide)
	{
		$this->id = $id;
		$this->idEtudiant = $idEtudiant;
		$this->codeFormation = $codeFormation;
		$this->anneeDebut = $anneeDebut;
		$this->anneeFin = $anneeFin;
		$this->cursus = $cursus;
		$this->etablissement = $etablissement;
		$this->note = $note;
		$this->valide = $valide;
	}

    /**
     * @param string $anneeDebut
     */
    public function setAnneeDebut ($anneeDebut) {
        $this->anneeDebut = $anneeDebut;
    }

    /**
     * @return string
     */
    public function getAnneeDebut () {
        return $this->anneeDebut;
    }

    /**
     * @param string $anneeFin
     */
    public function setAnneeFin ($anneeFin) {
        $this->anneeFin = $anneeFin;
    }

    /**
     * @return string
     */
    public function getAnneeFin () {
        return $this->anneeFin;
    }

    /**
     * @param string $codeFormation
     */
    public function setCodeFormation ($codeFormation) {
        $this->codeFormation = $codeFormation;
    }

    /**
     * @return string
     */
    public function getCodeFormation () {
        return $this->codeFormation;
    }

    /**
     * @param string $cursus
     */
    public function setCursus ($cursus) {
        $this->cursus = $cursus;
    }

    /**
     * @return string
     */
    public function getCursus () {
        return $this->cursus;
    }

    /**
     * @param string $etablissement
     */
    public function setEtablissement ($etablissement) {
        $this->etablissement = $etablissement;
    }

    /**
     * @return string
     */
    public function getEtablissement () {
        return $this->etablissement;
    }

    /**
     * @param string $id
     */
    public function setId ($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId () {
        return $this->id;
    }

    /**
     * @param string $idEtudiant
     */
    public function setIdEtudiant ($idEtudiant) {
        $this->idEtudiant = $idEtudiant;
    }

    /**
     * @return string
     */
    public function getIdEtudiant () {
        return $this->idEtudiant;
    }

    /**
     * @param string $note
     */
    public function setNote ($note) {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getNote () {
        return $this->note;
    }

    /**
     * @param string $valide
     */
    public function setValide ($valide) {
        $this->valide = $valide;
    }

    /**
     * @return string
     */
    public function getValide () {
        return $this->valide;
    }



}
