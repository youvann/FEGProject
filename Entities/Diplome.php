<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Diplome.php
 * @Purpose: Entité Diplome
 * @Author: Lionel Guissani
 */
class Diplome {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Nom
	 */
	private $nom;
	/**
	 * @var string Identidiant du dossier pdf duquel il dépend
	 */
	private $dossierPdf;

	/**
	 * Constructeur
	 * @param string $id Identifiant
	 * @param string $nom Nom
	 * @param string $dossierPdf Identidiant du dossier pdf duquel il dépend
	 */
	function __construct($id, $nom, $dossierPdf)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->dossierPdf = $dossierPdf;
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
}