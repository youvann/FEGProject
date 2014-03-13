<?php
/**
 * @Project: FEG Project
 * @File: /Entities/DocumentGeneral.php
 * @Purpose: Entité DocumentGeneral
 * @Author: Lionel Guissani
 */
class DocumentGeneral {
	/**
	 * @var string Identifiant
	 */
	private $id;
	/**
	 * @var string Nom
	 */
	private $nom;
	/**
	 * @var string Demandé en préinscription
	 */
	private $visible;

	/**
	 * @param $id string Identifiant
	 * @param $nom string Nom
	 * @param $visible string Demandé en préinscription
	 */
	function __construct($id, $nom, $visible) {
		$this->id = $id;
		$this->nom = $nom;
		$this->visible = $visible;
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
