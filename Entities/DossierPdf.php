<?php

class DossierPdf {

    private $id;
	private $nom;
    private $codeFormation;

	function __construct($id, $nom, $codeFormation)
	{
		$this->id = $id;
		$this->nom = $nom;
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
}