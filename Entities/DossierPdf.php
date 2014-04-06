<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DossierPdf.php
 * @Purpose: Entité DossierPdf
 * @Author: Lionel Guissani
 */
class DossierPdf {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Nom
	 */
	private $nom;
	/**
	 * @var string Informations préalables candidature
	 */
	private $informationsPrealablesCandidature;

	/**
	 * @var string Informations préalables préinscription
	 */
	private $informationsPrealablesPreinscription;
	/**
	 * @var string InformationsGenerales
	 */
	private $informationsGenerales;
	/**
	 * @var string Modalités
	 */
	private $modalites;
	/**
	 * @var string Code formation
	 */
    private $codeFormation;

	/**
	 * Constructeur
	 * @param $id string Identifiant
	 * @param $nom string Nom
	 * @param $informationsPrealablesCandidature string Informations préalables en Candidature
	 * @param $informationsPrealablesPreinscription string Informations préalables en Préinscription
	 * @param $informationsGenerales string Informations Générales
	 * @param $modalites string Modalités
	 * @param $codeFormation string Code formation
	 */
	function __construct($id, $nom, $informationsPrealablesCandidature, $informationsPrealablesPreinscription, $informationsGenerales, $modalites, $codeFormation)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->informationsPrealablesCandidature = $informationsPrealablesCandidature;
		$this->informationsPrealablesPreinscription = $informationsPrealablesPreinscription;
		$this->informationsGenerales = $informationsGenerales;
		$this->modalites = $modalites;
		$this->codeFormation = $codeFormation;
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
	 * @param string $informationsPrealablesCandidature
	 */
	public function setInformationsPrealablesCandidature($informationsPrealablesCandidature)
	{
		$this->informationsPrealablesCandidature = $informationsPrealablesCandidature;
	}

	/**
	 * @return string
	 */
	public function getInformationsPrealablesCandidature()
	{
		return $this->informationsPrealablesCandidature;
	}

	/**
	 * @param string $informationsPrealablesPreinscription
	 */
	public function setInformationsPrealablesPreinscription($informationsPrealablesPreinscription)
	{
		$this->informationsPrealablesPreinscription = $informationsPrealablesPreinscription;
	}

	/**
	 * @return string
	 */
	public function getInformationsPrealablesPreinscription()
	{
		return $this->informationsPrealablesPreinscription;
	}

	/**
	 * @param string $informationsGenerales
	 */
	public function setInformationsGenerales($informationsGenerales)
	{
		$this->informationsGenerales = $informationsGenerales;
	}

	/**
	 * @return string
	 */
	public function getInformationsGenerales()
	{
		return $this->informationsGenerales;
	}

	/**
	 * @param string $modalites
	 */
	public function setModalites($modalites)
	{
		$this->modalites = $modalites;
	}

	/**
	 * @return string
	 */
	public function getModalites()
	{
		return $this->modalites;
	}
}