<?php

class Diplome {
	private $id;
	private $nom;
	private $dossierPdf;

	function __construct($id, $nom, $dossierPdf)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->dossierPdf = $dossierPdf;
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
	 * @param mixed $dossierPdf
	 */
	public function setDossierPdf($dossierPdf)
	{
		$this->dossierPdf = $dossierPdf;
	}

	/**
	 * @return mixed
	 */
	public function getDossierPdf()
	{
		return $this->dossierPdf;
	}
}