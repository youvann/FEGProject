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
	 * @var string Informations
	 */
	private $informations;
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
	 * @param $informations string Informations
	 * @param $modalites string Modalités
	 * @param $codeFormation string Code formation
	 */
	function __construct($id, $nom, $informations, $modalites, $codeFormation)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->informations = $informations;
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