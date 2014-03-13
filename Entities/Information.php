<?php
/**
 * @Project: FEG Project
 * @File: /Entities/Information.php
 * @Purpose: Entité Information
 * @Author: Lionel Guissani
 */
class Information {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Type
	 */
	private $type;
	/**
	 * @var string Dossier pdf
	 */
	private $dossierPdf;
	/**
	 * @var string Libellé
	 */
	private $libelle;
	/**
	 * @var string Explications
	 */
	private $explications;
	/**
	 * @var string Ordre
	 */
	private $ordre;

	/**
	 * Constructeur
	 * @param $id string Identifiant
	 * @param $type string Type
	 * @param $dossierPdf string Dossier pdf
	 * @param $libelle string Libellé
	 * @param $explications string Explications
	 * @param $ordre string Ordre
	 */
	function __construct($id, $type, $dossierPdf, $libelle, $explications, $ordre) {
		$this->id = $id;
		$this->type = $type;
		$this->dossierPdf = $dossierPdf;
		$this->libelle = $libelle;
		$this->explications = $explications;
		$this->ordre = $ordre;
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
	 * @param string $explications
	 */
	public function setExplications($explications)
	{
		$this->explications = $explications;
	}

	/**
	 * @return string
	 */
	public function getExplications()
	{
		return $this->explications;
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
	 * @param string $libelle
	 */
	public function setLibelle($libelle)
	{
		$this->libelle = $libelle;
	}

	/**
	 * @return string
	 */
	public function getLibelle()
	{
		return $this->libelle;
	}

	/**
	 * @param string $ordre
	 */
	public function setOrdre($ordre)
	{
		$this->ordre = $ordre;
	}

	/**
	 * @return string
	 */
	public function getOrdre()
	{
		return $this->ordre;
	}

	/**
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

}