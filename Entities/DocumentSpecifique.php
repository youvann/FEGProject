<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DocumentSpecifique.php
 * @Purpose: Entité DocumentSpecifique
 * @Author: Lionel Guissani
 */
class DocumentSpecifique {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Identifiant du dossier pdf auquel il appartient
	 */
	private $dossierPdf;
	/**
	 * @var string Nom
	 */
	private $nom;
	/**
	 * @var string Demandé en préinscription
	 */
	private $visible;
	/**
	 * @var string Adresse URL
	 */
	private $url;

	/**
	 * @param $id string Identifiant
	 * @param $dossierPdf string Identifiant du dossier pdf auquel il appartient
	 * @param $nom string Nom
	 * @param $visible string Demandé en préinscription
	 * @param $url string Adresse URL
	 */
	function __construct($id, $dossierPdf, $nom, $visible, $url) {
		$this->id = $id;
		$this->dossierPdf = $dossierPdf;
		$this->nom = $nom;
		$this->visible = $visible;
		$this->url = $url;
	}

	/**
	 * @param string $dossierPdf
	 */
	public function setDossierPdf($dossierPdf)
	{
		$this->dossierPdf = $dossierPdf;
	}

	/**
	 * @return string
	 */
	public function getDossierPdf()
	{
		return $this->dossierPdf;
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
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param string $visible
	 */
	public function setVisible($visible)
	{
		$this->visible = $visible;
	}

	/**
	 * @return string
	 */
	public function getVisible()
	{
		return $this->visible;
	}
}
