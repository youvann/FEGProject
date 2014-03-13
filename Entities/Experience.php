<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Experience.php
 * @Purpose: Entité Experience
 * @Author: Lionel Guissani
 */
class Experience {
	/**
	 * @var string Identifiant
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
	 * @var string Mois de début
	 */
	private $moisDebut;
	/**
	 * @var string Année de début
	 */
	private $anneeDebut;
	/**
	 * @var string Mois de fin
	 */
	private $moisFin;
	/**
	 * @var string Année de fin
	 */
	private $anneeFin;
	/**
	 * @var string Entreprise
	 */
	private $entreprise;
	/**
	 * @var string Fonction
	 */
	private $fonction;

	/**
	 * Constructeur
	 * @param $id string Identifiant
	 * @param $idEtudiant string Identifiant de l'étudiant
	 * @param $codeFormation string Code formation
	 * @param $moisDebut string Mois de début
	 * @param $anneeDebut string Année de début
	 * @param $moisFin string Mois de fin
	 * @param $anneeFin string Année de fin
	 * @param $entreprise string Entreprise
	 * @param $fonction string Fonction
	 */
	function __construct($id, $idEtudiant, $codeFormation, $moisDebut, $anneeDebut, $moisFin, $anneeFin, $entreprise, $fonction) {
		$this->id = $id;
		$this->idEtudiant = $idEtudiant;
		$this->codeFormation = $codeFormation;
		$this->moisDebut = $moisDebut;
		$this->anneeDebut = $anneeDebut;
		$this->moisFin = $moisFin;
		$this->anneeFin = $anneeFin;
		$this->entreprise = $entreprise;
		$this->fonction = $fonction;
	}

	/**
	 * @param string $anneeDebut
	 */
	public function setAnneeDebut($anneeDebut)
	{
		$this->anneeDebut = $anneeDebut;
	}

	/**
	 * @return string
	 */
	public function getAnneeDebut()
	{
		return $this->anneeDebut;
	}

	/**
	 * @param string $anneeFin
	 */
	public function setAnneeFin($anneeFin)
	{
		$this->anneeFin = $anneeFin;
	}

	/**
	 * @return string
	 */
	public function getAnneeFin()
	{
		return $this->anneeFin;
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
	 * @param string $entreprise
	 */
	public function setEntreprise($entreprise)
	{
		$this->entreprise = $entreprise;
	}

	/**
	 * @return string
	 */
	public function getEntreprise()
	{
		return $this->entreprise;
	}

	/**
	 * @param string $fonction
	 */
	public function setFonction($fonction)
	{
		$this->fonction = $fonction;
	}

	/**
	 * @return string
	 */
	public function getFonction()
	{
		return $this->fonction;
	}

	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
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
	 * @param string $moisDebut
	 */
	public function setMoisDebut($moisDebut)
	{
		$this->moisDebut = $moisDebut;
	}

	/**
	 * @return string
	 */
	public function getMoisDebut()
	{
		return $this->moisDebut;
	}

	/**
	 * @param string $moisFin
	 */
	public function setMoisFin($moisFin)
	{
		$this->moisFin = $moisFin;
	}

	/**
	 * @return string
	 */
	public function getMoisFin()
	{
		return $this->moisFin;
	}


}
