<?php

class DocumentSpecifique {
	private $id;
	private $dossierPdf;
	private $nom;
	private $visible;
	private $url;
	
	function __construct($id, $dossierPdf, $nom, $visible, $url) {
		$this->id = $id;
		$this->dossierPdf = $dossierPdf;
		$this->nom = $nom;
		$this->visible = $visible;
		$this->url = $url;
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
	 * @param mixed $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param mixed $visible
	 */
	public function setVisible($visible)
	{
		$this->visible = $visible;
	}

	/**
	 * @return mixed
	 */
	public function getVisible()
	{
		return $this->visible;
	}


}
