<?php

class DossierPdf {

    private $id;
	private $nom;
	private $informations;
	private $modalites;
    private $codeFormation;

	function __construct($id, $nom, $informations, $modalites, $codeFormation)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->informations = $informations;
		$this->modalites = $modalites;
		$this->codeFormation = $codeFormation;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
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
	 * @param mixed $modalites
	 */
	public function setModalites($modalites)
	{
		$this->modalites = $modalites;
	}

	/**
	 * @return mixed
	 */
	public function getModalites()
	{
		return $this->modalites;
	}
}